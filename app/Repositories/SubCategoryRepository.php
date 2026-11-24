<?php

namespace App\Repositories;

use App\Models\SubCategory;
use App\Interfaces\SubCategoryRepositoryInterface;

class SubCategoryRepository implements SubCategoryRepositoryInterface
{
    public function getAll()
    {
        return SubCategory::all();
    }

    public function getActiveSubCategories()
    {
        return SubCategory::where('status', 1)->get();
    }

    public function getById(string $id)
    {
        return SubCategory::findOrFail($id);
    }

    public function getBySlug(string $slug)
    {
        return SubCategory::where('slug', $slug)->firstOrFail();
    }

    public function getSubCategoryByCategoryId($categoryId)
    {
        return SubCategory::where('category_id', $categoryId)->get();
    }

    public function getActiveSubCategoryByCategoryId($categoryId)
    {
        return SubCategory::where('category_id', $categoryId)->where('status', 1)->get();
    }

    public function getSubCategoryCountByCategory($categoryId)
    {
        return SubCategory::where('category_id', $categoryId)->count();
    }

    public function create(array $data)
    {
        return SubCategory::create($this->formatData($data));
    }

    public function update(array $data, string $id)
    {
        $subCategory = SubCategory::findOrFail($id);
        $subCategory->update($this->formatData($data));
        return $subCategory;
    }

    public function delete($id)
    {
        return SubCategory::findOrFail($id)->delete();
    }

    public function updateStatus($data, $id)
    {
        return SubCategory::find($id)->update($data);
    }

    protected function formatData(array $data): array
    {
        if (isset($data['category']) && !isset($data['category_id'])) {
            $data['category_id'] = $data['category'];
            unset($data['category']);
        }
        return $data;
    }
}
