<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Interfaces\VendorShopProfileRepositoryInterface;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorShopProfileController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $profile = app(VendorShopProfileRepositoryInterface::class)->getProfileByUserId(Auth::user()->id);
        return view('vendor.shop-profile.index', compact('profile'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'banner' => ['nullable','image', 'max:3000'],
            'shop_name' => ['required', 'max:200'],
            'phone' => ['required', 'max:50'],
            'email' => ['required', 'email', 'max:200'],
            'address' => ['required'],
            'description' => ['required'],
            'fb_link' => ['nullable', 'url'],
            'tw_link' => ['nullable', 'url'],
            'insta_link' => ['nullable', 'url'],
        ]);

        $vendorRepo = app(VendorShopProfileRepositoryInterface::class);
        $vendor = $vendorRepo->getProfileByUserId(Auth::user()->id);
        $bannerPath = $this->updateImage($request, 'banner', 'uploads', $vendor?->banner);

        $data = [
            'banner' => empty(!$bannerPath) ? $bannerPath : $vendor?->banner,
            'shop_name' => $request->shop_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'address' => $request->address,
            'description' => $request->description,
            'fb_link' => $request->fb_link,
            'tw_link' => $request->tw_link,
            'insta_link' => $request->insta_link,
        ];

        $vendorRepo->updateOrCreate(['user_id' => Auth::user()->id], $data);

        toastr('Updated Successfully!', 'success');

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
