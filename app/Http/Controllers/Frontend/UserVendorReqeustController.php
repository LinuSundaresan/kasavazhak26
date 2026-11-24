<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Interfaces\VendorShopProfileRepositoryInterface;
use App\Models\Vendor;
use App\Models\VendorCondition;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserVendorReqeustController extends Controller
{
    use ImageUploadTrait;

    public function index()
    {
        $content = VendorCondition::first();
        return view('frontend.dashboard.vendor-request.index', compact('content'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'shop_image' => ['required', 'image', 'max:3000'],
            'shop_name' => ['required', 'max:200'],
            'shop_email' => ['required', 'email'],
            'shop_phone' => ['required', 'max:200'],
            'shop_address' => ['required'],
            'about' => ['required']
        ]);

        if(Auth::user()->role === 'vendor'){
            return redirect()->back();
        }

        $imagePath = $this->uploadImage($request, 'shop_image', 'uploads');

        $data = [
            'banner' => $imagePath,
            'phone' => $request->shop_phone,
            'email' => $request->shop_email,
            'address' => $request->shop_address,
            'description' => $request->about,
            'shop_name' => $request->shop_name,
            'user_id' => Auth::user()->id,
            'status' => 0,
        ];

        app(VendorShopProfileRepositoryInterface::class)->create($data);

        toastr('Submitted successfully please wait for approve!', 'success', 'success');

        return redirect()->back();

    }
}
