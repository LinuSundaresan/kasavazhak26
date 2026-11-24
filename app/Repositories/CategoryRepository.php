<?php

namespace App\Repositories;

use App\Models\Category;
use App\Interfaces\CategoryRepositoryInterface;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll()
    {
        return Category::all();
    }

    public function getActiveCategories()
    {
        return Category::where('status', 1)->get();
    }

    public function getById(string $id)
    {
        return Category::findOrFail($id);
    }

    public function getBySlug(string $slug)
    {
        return Category::where('slug', $slug)->firstOrFail();
    }

    public function create(array $data)
    {
        return Category::create($data);
    }

    public function update(array $data, string $id)
    {
        $category = Category::findOrFail($id);
        $category->update($data);
        return $category;
    }

    public function delete($id)
    {
        return Category::findOrFail($id)->delete();
    }

    public function updateStatus($data, $id)
    {
        return Category::find($id)->update($data);
    }
}
