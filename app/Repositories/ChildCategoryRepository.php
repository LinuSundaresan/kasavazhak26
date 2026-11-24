<?php

namespace App\Repositories;

use App\Models\ChildCategory;
use App\Interfaces\ChildCategoryRepositoryInterface;

class ChildCategoryRepository implements ChildCategoryRepositoryInterface
{
    public function getAll()
    {
        return ChildCategory::all();
    }

    public function getById(string $id)
    {
        return ChildCategory::findOrFail($id);
    }

    public function getBySlug(string $slug)
    {
        return ChildCategory::where('slug', $slug)->firstOrFail();
    }

    public function getChildCategoryBySubCategoryId($subCategoryId)
    {
        return ChildCategory::where('sub_category_id', $subCategoryId)->get();
    }

    public function getActiveChildCategoryBySubCategoryId($subCategoryId)
    {
        return ChildCategory::where('sub_category_id', $subCategoryId)->where('status', 1)->get();
    }

    public function getChildCategoryCountBySubCategory($subCategoryId)
    {
        return ChildCategory::where('sub_category_id', $subCategoryId)->count();
    }

    public function create(array $data)
    {
        return ChildCategory::create($this->formatData($data));
    }

    public function update(array $data, string $id)
    {
        $childCategory = ChildCategory::findOrFail($id);
        $childCategory->update($this->formatData($data));
        return $childCategory;
    }

    public function delete($id)
    {
        return ChildCategory::findOrFail($id)->delete();
    }

    public function updateStatus($data, $id)
    {
        return ChildCategory::find($id)->update($data);
    }

    protected function formatData(array $data): array
    {
        if (isset($data['category']) && !isset($data['category_id'])) {
            $data['category_id'] = $data['category'];
            unset($data['category']);
        }
        if (isset($data['sub_category']) && !isset($data['sub_category_id'])) {
            $data['sub_category_id'] = $data['sub_category'];
            unset($data['sub_category']);
        }
        return $data;
    }
}
