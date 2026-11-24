<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\BrandDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\BrandRepositoryInterface;
use App\Models\Product;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Str;

class BrandController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(BrandDataTable $dataTable)
    {
        return $dataTable->render('admin.brand.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'logo' => ['image', 'required', 'max:2000'],
            'name' => ['required', 'max:200'],
            'is_featured' => ['required'],
            'status' => ['required']
        ]);

        $logoPath = $this->uploadImage($request, 'logo', 'uploads');

        $data = [
            'logo' => $logoPath,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_featured' => $request->is_featured,
            'status' => $request->status,
        ];

        app(BrandRepositoryInterface::class)->create($data);

        toastr('Created Successfully!', 'success');
        return redirect()->route('admin.brand.index');
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
        $brand = app(BrandRepositoryInterface::class)->getById($id);
        return view('admin.brand.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'logo' => ['image', 'max:2000'],
            'name' => ['required', 'max:200'],
            'is_featured' => ['required'],
            'status' => ['required']
        ]);

        $brand = app(BrandRepositoryInterface::class)->getById($id);

        $logoPath = $this->updateImage($request, 'logo', 'uploads', $brand->logo);

        $data = [
            'logo' => empty(!$logoPath) ? $logoPath : $brand->logo,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'is_featured' => $request->is_featured,
            'status' => $request->status,
        ];

        app(BrandRepositoryInterface::class)->update($data, $id);

        toastr('Updated Successfully!', 'success');
        return redirect()->route('admin.brand.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $brand = app(BrandRepositoryInterface::class)->getById($id);
        if(Product::where('brand_id', $brand->id)->count() > 0){
            return response(['status' => 'error', 'message' => 'This brand have products you can\'t delete it.']);
        }
        $this->deleteImage($brand->logo);
        app(BrandRepositoryInterface::class)->delete($id);

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $status = ($request->status === 'true' || $request->status === true || $request->status == 1) ? 1 : 0;
        app(BrandRepositoryInterface::class)->updateStatus(['status' => $status], $request->id);

        return response(['message' => 'Status has been updated!']);
    }

    public function updateStatus(Request $request)
    {
        return $this->changeStatus($request);
    }
}
