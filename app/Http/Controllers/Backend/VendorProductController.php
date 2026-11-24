<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\BrandRepositoryInterface;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ChildCategoryRepositoryInterface;
use App\Interfaces\ProductImageGalleryRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductVariantRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Str;

class VendorProductController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(VendorProductDataTable $dataTable)
    {
        return $dataTable->render('vendor.product.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = app(CategoryRepositoryInterface::class)->getAll();
        $brands = app(BrandRepositoryInterface::class)->getAll();
        return view('vendor.product.create', compact('categories', 'brands'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max: 600'],
            'long_description' => ['required'],
            'seo_title' => ['nullable','max:200'],
            'seo_description' => ['nullable','max:250'],
            'status' => ['required']
        ]);

        /** Handle the image upload */
        $imagePath = $this->uploadImage($request, 'image', 'uploads');

        $data = [
            'thumb_image' => $imagePath,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'vendor_id' => Auth::user()->vendor->id,
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'child_category_id' => $request->child_category,
            'brand_id' => $request->brand,
            'qty' => $request->qty,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'video_link' => $request->video_link,
            'sku' => $request->sku,
            'price' => $request->price,
            'offer_price' => $request->offer_price,
            'offer_start_date' => $request->offer_start_date,
            'offer_end_date' => $request->offer_end_date,
            'product_type' => $request->product_type,
            'status' => $request->status,
            'is_approved' => 0,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ];

        app(ProductRepositoryInterface::class)->create($data);

        toastr('Created Successfully!', 'success');

        return redirect()->route('vendor.products.index');
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
        $product = app(ProductRepositoryInterface::class)->getById($id);

        /** Check if it's the owner of the product */
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }

        $subCategories = app(SubCategoryRepositoryInterface::class)->getSubCategoryByCategoryId($product->category_id);
        $childCategories = app(ChildCategoryRepositoryInterface::class)->getChildCategoryBySubCategoryId($product->sub_category_id);
        $categories = app(CategoryRepositoryInterface::class)->getAll();
        $brands = app(BrandRepositoryInterface::class)->getAll();

        return view('vendor.product.edit',
        compact(
            'product',
            'subCategories',
            'childCategories',
            'categories',
            'brands'
        ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'image' => ['nullable', 'image', 'max:3000'],
            'name' => ['required', 'max:200'],
            'category' => ['required'],
            'brand' => ['required'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max: 600'],
            'long_description' => ['required'],
            'seo_title' => ['nullable','max:200'],
            'seo_description' => ['nullable','max:250'],
            'status' => ['required']
        ]);

        $product = app(ProductRepositoryInterface::class)->getById($id);

        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }

        /** Handle the image upload */
        $imagePath = $this->updateImage($request, 'image', 'uploads', $product->thumb_image);

        $data = [
            'thumb_image' => empty(!$imagePath) ? $imagePath : $product->thumb_image,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'vendor_id' => Auth::user()->vendor->id,
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'child_category_id' => $request->child_category,
            'brand_id' => $request->brand,
            'qty' => $request->qty,
            'short_description' => $request->short_description,
            'long_description' => $request->long_description,
            'video_link' => $request->video_link,
            'sku' => $request->sku,
            'price' => $request->price,
            'offer_price' => $request->offer_price,
            'offer_start_date' => $request->offer_start_date,
            'offer_end_date' => $request->offer_end_date,
            'product_type' => $request->product_type,
            'status' => $request->status,
            'is_approved' => $product->is_approved,
            'seo_title' => $request->seo_title,
            'seo_description' => $request->seo_description,
        ];

        app(ProductRepositoryInterface::class)->update($data, $id);

        toastr('Updated Successfully!', 'success');

        return redirect()->route('vendor.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = app(ProductRepositoryInterface::class)->getById($id);
        if($product->vendor_id != Auth::user()->vendor->id){
            abort(404);
        }

        /** Delete the main product image */
        $this->deleteImage($product->thumb_image);

        /** Delete product gallery images */
        $galleryImages = app(ProductImageGalleryRepositoryInterface::class)->getAllGaleryByProductId($product->id);
        foreach($galleryImages as $image){
            $this->deleteImage($image->image);
            $image->delete();
        }

        /** Delete product variants if exist */
        $variants = app(ProductVariantRepositoryInterface::class)->getProductVariantsByProduct($product->id);

        foreach($variants as $variant){
            $variant->productVariantItems()->delete();
            $variant->delete();
        }

        app(ProductRepositoryInterface::class)->delete($id);

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status == 'true' ? 1 : 0;
        app(ProductRepositoryInterface::class)->updateStatus(['status' => $status], $request->id);

        return response(['message' => 'Status has been updated!']);
    }

    public function updateStatus(Request $request)
    {
        return $this->changeStatus($request);
    }

    /**
     * Get all product sub categores
     */
    public function getSubCategories(Request $request)
    {
        $subCategories = app(SubCategoryRepositoryInterface::class)->getSubCategoryByCategoryId($request->id);
        return $subCategories;
    }

    public function getChildCategories(Request $request)
    {
        $childCategories = app(ChildCategoryRepositoryInterface::class)->getChildCategoryBySubCategoryId($request->id);
        return $childCategories;
    }
}
