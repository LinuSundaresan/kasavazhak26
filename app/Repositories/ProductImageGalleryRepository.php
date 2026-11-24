<?php

namespace App\Repositories;

use App\Models\ProductImageGallery;
use App\Interfaces\ProductImageGalleryRepositoryInterface;

class ProductImageGalleryRepository implements ProductImageGalleryRepositoryInterface
{
    public function getAllGaleryByProductId($productId)
    {
        return ProductImageGallery::where('product_id', $productId)->get();
    }

    public function getAllGalleryByProductId($productId)
    {
        return ProductImageGallery::where('product_id', $productId)->get();
    }

    public function getById(string $id)
    {
        return ProductImageGallery::findOrFail($id);
    }

    public function create(array $data)
    {
        return ProductImageGallery::create($data);
    }

    public function delete($id)
    {
        return ProductImageGallery::findOrFail($id)->delete();
    }
}
