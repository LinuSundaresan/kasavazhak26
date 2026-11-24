<?php

namespace App\Repositories;

use App\Models\Brand;
use App\Interfaces\BrandRepositoryInterface;

class BrandRepository implements BrandRepositoryInterface
{
    public function getAll()
    {
        return Brand::all();
    }

    public function getActiveBrands()
    {
        return Brand::where('status', 1)->get();
    }

    public function getFeaturedBrands()
    {
        return Brand::where('status', 1)->where('is_featured', 1)->get();
    }

    public function getById(string $id)
    {
        return Brand::findOrFail($id);
    }

    public function getBySlug(string $slug)
    {
        return Brand::where('slug', $slug)->firstOrFail();
    }

    public function create(array $data)
    {
        return Brand::create($data);
    }

    public function update(array $data, string $id)
    {
        $brand = Brand::findOrFail($id);
        $brand->update($data);
        return $brand;
    }

    public function delete($id)
    {
        return Brand::findOrFail($id)->delete();
    }

    public function updateStatus($data, $id)
    {
        return Brand::find($id)->update($data);
    }
}
