<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\PaypalSettingRepositoryInterface;
use App\Interfaces\RazorpaySettingRepositoryInterface;
use App\Interfaces\StripeSettingRepositoryInterface;
use App\Models\CodSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index()
    {
        $paypalSetting = app(PaypalSettingRepositoryInterface::class)->getPaypalSetting();
        $stripeSetting = app(StripeSettingRepositoryInterface::class)->getStripeSetting();
        $razorpaySetting = app(RazorpaySettingRepositoryInterface::class)->getRazorpaySetting();
        $codSetting = CodSetting::first();

        return view('admin.payment-settings.index', compact('paypalSetting', 'stripeSetting', 'razorpaySetting', 'codSetting'));
    }
}
