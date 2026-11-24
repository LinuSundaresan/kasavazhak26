<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ChildCategoryDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\CategoryRepositoryInterface;
use App\Interfaces\ChildCategoryRepositoryInterface;
use App\Interfaces\HomepageSettingRepositoryInterface;
use App\Interfaces\SubCategoryRepositoryInterface;
use App\Models\Product;
use Illuminate\Http\Request;
use Str;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ChildCategoryDataTable $dataTable)
    {
        return $dataTable->render('admin.child-category.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = app(CategoryRepositoryInterface::class)->getAll();
        return view('admin.child-category.create', compact('categories'));
    }

    /**
     * Get sub categories
     */
    public function getSubCategories(Request $request)
    {
        return app(SubCategoryRepositoryInterface::class)->getActiveSubCategoryByCategoryId($request->id);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'category' => ['required'],
            'sub_category' => ['required'],
            'name' => ['required', 'max:200', 'unique:child_categories,name'],
            'status' => ['required']
        ]);

        $data = [
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ];

        app(ChildCategoryRepositoryInterface::class)->create($data);

        toastr('Created Successfully!', 'success');

        return redirect()->route('admin.child-category.index');
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
        $categories = app(CategoryRepositoryInterface::class)->getAll();
        $childCategory = app(ChildCategoryRepositoryInterface::class)->getById($id);
        $subCategories = app(SubCategoryRepositoryInterface::class)->getSubCategoryByCategoryId($childCategory->category_id);

        return view('admin.child-category.edit', compact('categories', 'childCategory', 'subCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'category' => ['required'],
            'sub_category' => ['required'],
            'name' => ['required', 'max:200', 'unique:child_categories,name,' . $id],
            'status' => ['required']
        ]);

        $data = [
            'category_id' => $request->category,
            'sub_category_id' => $request->sub_category,
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ];

        app(ChildCategoryRepositoryInterface::class)->update($data, $id);

        toastr('Update Successfully!', 'success');

        return redirect()->route('admin.child-category.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $childCategory = app(ChildCategoryRepositoryInterface::class)->getById($id);

        if (Product::where('child_category_id', $childCategory->id)->count() > 0) {
            return response(['status' => 'error', 'message' => 'This item contain relation can\'t delete it.']);
        }

        $homeSettings = app(HomepageSettingRepositoryInterface::class)->getAll();

        foreach ($homeSettings as $item) {
            $array = json_decode($item->value, true);
            $collection = collect($array);
            if ($collection->contains('child_category', $childCategory->id)) {
                return response(['status' => 'error', 'message' => 'This item contain relation can\'t delete it.']);
            }
        }

        app(ChildCategoryRepositoryInterface::class)->delete($id);

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $status = ($request->status === 'true' || $request->status === true || $request->status == 1) ? 1 : 0;
        app(ChildCategoryRepositoryInterface::class)->updateStatus(['status' => $status], $request->id);

        return response(['message' => 'Status has been updated!']);
    }

    public function updateStatus(Request $request)
    {
        return $this->changeStatus($request);
    }
}
