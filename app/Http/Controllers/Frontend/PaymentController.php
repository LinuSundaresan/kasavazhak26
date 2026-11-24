<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\GeneralSettingRepositoryInterface;
use App\Interfaces\OrderProductRepositoryInterface;
use App\Interfaces\OrderRepositoryInterface;
use App\Interfaces\PaypalSettingRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\RazorpaySettingRepositoryInterface;
use App\Interfaces\StripeSettingRepositoryInterface;
use App\Interfaces\TransactionRepositoryInterface;
use App\Models\CodSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Srmklive\PayPal\Services\PayPal as PayPalClient;
use Stripe\Charge;
use Stripe\Stripe;
use Razorpay\Api\Api;

class PaymentController extends Controller
{
    public function index()
    {
        if(!Session::has('address')){
            return redirect()->route('user.checkout');
        }
        return view('frontend.pages.payment');
    }

    public function paymentSuccess()
    {
        return view('frontend.pages.payment-success');
    }

    public function storeOrder($paymentMethod, $paymentStatus, $transactionId, $paidAmount, $paidCurrencyName)
    {
        $setting = app(GeneralSettingRepositoryInterface::class)->getGeneralSetting();

        $orderData = [
            'invocie_id' => rand(1, 999999),
            'user_id' => Auth::user()->id,
            'sub_total' => getCartTotal(),
            'amount' =>  getFinalPayableAmount(),
            'currency_name' => $setting->currency_name,
            'currency_icon' => $setting->currency_icon,
            'product_qty' => \Cart::content()->count(),
            'payment_method' => $paymentMethod,
            'payment_status' => $paymentStatus,
            'order_address' => json_encode(Session::get('address')),
            'shpping_method' => json_encode(Session::get('shipping_method')),
            'coupon' => json_encode(Session::get('coupon')),
            'order_status' => 'pending',
        ];

        $order = app(OrderRepositoryInterface::class)->create($orderData);

        // store order products
        $productRepo = app(ProductRepositoryInterface::class);
        $orderProductRepo = app(OrderProductRepositoryInterface::class);

        foreach(\Cart::content() as $item){
            $product = $productRepo->getById($item->id);

            $orderProductData = [
                'order_id' => $order->id,
                'product_id' => $product->id,
                'vendor_id' => $product->vendor_id,
                'product_name' => $product->name,
                'variants' => json_encode($item->options->variants),
                'variant_total' => $item->options->variants_total,
                'unit_price' => $item->price,
                'qty' => $item->qty,
            ];

            $orderProductRepo->create($orderProductData);

            // update product quantity
            $updatedQty = ($product->qty - $item->qty);
            $productRepo->update(['qty' => $updatedQty], $product->id);
        }

        // store transaction details
        $transactionData = [
            'order_id' => $order->id,
            'transaction_id' => $transactionId,
            'payment_method' => $paymentMethod,
            'amount' => getFinalPayableAmount(),
            'amount_real_currency' => $paidAmount,
            'amount_real_currency_name' => $paidCurrencyName,
        ];

        app(TransactionRepositoryInterface::class)->create($transactionData);
    }

    public function clearSession()
    {
        \Cart::destroy();
        Session::forget('address');
        Session::forget('shipping_method');
        Session::forget('coupon');
    }

    public function paypalConfig()
    {
        $paypalSetting = app(PaypalSettingRepositoryInterface::class)->getPaypalSetting();
        $config = [
            'mode'    => $paypalSetting->mode === 1 ? 'live' : 'sandbox',
            'sandbox' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => 'APP-80W284485P519543T',
            ],
            'live' => [
                'client_id'         => $paypalSetting->client_id,
                'client_secret'     => $paypalSetting->secret_key,
                'app_id'            => '',
            ],

            'payment_action' => 'Sale',
            'currency'       => $paypalSetting->currency_name,
            'notify_url'     => '',
            'locale'         => 'en_US',
            'validate_ssl'   =>  true,
        ];
        return $config;
    }

    /** Paypal redirect */
    public function payWithPaypal()
    {
        $config = $this->paypalConfig();
        $paypalSetting = app(PaypalSettingRepositoryInterface::class)->getPaypalSetting();

        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        // calculate payable amount depending on currency rate
        $total = getFinalPayableAmount();
        $payableAmount = round($total*$paypalSetting->currency_rate, 2);

        $response = $provider->createOrder([
            "intent" => "CAPTURE",
            "application_context" => [
                "return_url" => route('user.paypal.success'),
                "cancel_url" => route('user.paypal.cancel'),
            ],
            "purchase_units" => [
                [
                    "amount" => [
                        "currency_code" => $config['currency'],
                        "value" => $payableAmount
                    ]
                ]
            ]
        ]);

        if(isset($response['id']) && $response['id'] != null){
            foreach($response['links'] as $link){
                if($link['rel'] === 'approve'){
                    return redirect()->away($link['href']);
                }
            }
        } else {
            return redirect()->route('user.paypal.cancel');
        }
    }

    public function paypalSuccess(Request $request)
    {
        $config = $this->paypalConfig();
        $provider = new PayPalClient($config);
        $provider->getAccessToken();

        $response = $provider->capturePaymentOrder($request->token);

        if (isset($response['status']) && $response['status'] == 'COMPLETED') {

            // calculate payable amount depending on currency rate
            $paypalSetting = app(PaypalSettingRepositoryInterface::class)->getPaypalSetting();
            $total = getFinalPayableAmount();
            $paidAmount = round($total*$paypalSetting->currency_rate, 2);

            $this->storeOrder('paypal', 1, $response['id'], $paidAmount, $paypalSetting->currency_name);

            // clear session
            $this->clearSession();

            return redirect()->route('user.payment.success');
        }

        return redirect()->route('user.paypal.cancel');
    }

    public function paypalCancel()
    {
        toastr('Someting went wrong try agin later!', 'error', 'Error');
        return redirect()->route('user.payment');
    }

    /** Stripe Payment */
    public function payWithStripe(Request $request)
    {
        // calculate payable amount depending on currency rate
        $stripeSetting = app(StripeSettingRepositoryInterface::class)->getStripeSetting();
        $total = getFinalPayableAmount();
        $payableAmount = round($total * $stripeSetting->currency_rate, 2);

        Stripe::setApiKey($stripeSetting->secret_key);
        $response = Charge::create([
            "amount" => $payableAmount * 100,
            "currency" => $stripeSetting->currency_name,
            "source" => $request->stripe_token,
            "description" => "product purchase!"
        ]);

        if($response->status === 'succeeded'){
            $this->storeOrder('stripe', 1, $response->id, $payableAmount, $stripeSetting->currency_name);
            // clear session
            $this->clearSession();

            return redirect()->route('user.payment.success');
        }else {
            toastr('Someting went wrong try agin later!', 'error', 'Error');
            return redirect()->route('user.payment');
        }
    }

    /** Razorpay payment */
    public function payWithRazorPay(Request $request)
    {
       $razorPaySetting = app(RazorpaySettingRepositoryInterface::class)->getRazorpaySetting();
       $api = new Api($razorPaySetting->razorpay_key, $razorPaySetting->razorpay_secret_key);

       // amount calculation
       $total = getFinalPayableAmount();
       $payableAmount = round($total * $razorPaySetting->currency_rate, 2);
       $payableAmountInPaisa = $payableAmount * 100;

       if($request->has('razorpay_payment_id') && $request->filled('razorpay_payment_id')){
            try{
                $response = $api->payment->fetch($request->razorpay_payment_id)
                    ->capture(['amount' => $payableAmountInPaisa]);
            }catch(\Exception $e){
                toastr($e->getMessage(), 'error', 'Error');
                return redirect()->back();
            }

            if($response['status'] == 'captured'){
                $this->storeOrder('razorpay', 1, $response['id'], $payableAmount, $razorPaySetting->currency_name);
                // clear session
                $this->clearSession();

                return redirect()->route('user.payment.success');
            }
       }
    }

    /** pay with cod */
    public function payWithCod(Request $request)
    {
        $codPaySetting = CodSetting::first();
        $setting = app(GeneralSettingRepositoryInterface::class)->getGeneralSetting();
        if($codPaySetting->status == 0){
            return redirect()->back();
        }

        // amount calculation
        $total = getFinalPayableAmount();
        $payableAmount = round($total, 2);

        $this->storeOrder('COD', 0, \Str::random(10), $payableAmount, $setting->currency_name);
        // clear session
        $this->clearSession();

        return redirect()->route('user.payment.success');
    }
}
