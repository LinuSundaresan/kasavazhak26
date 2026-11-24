<?php

namespace App\Repositories;

use App\Models\ProductVariant;
use App\Interfaces\ProductVariantRepositoryInterface;

class ProductVariantRepository implements ProductVariantRepositoryInterface
{
    public function getProductVariantsByProduct($productId)
    {
        return ProductVariant::where('product_id', $productId)->get();
    }

    public function getById(string $id)
    {
        return ProductVariant::findOrFail($id);
    }

    public function create(array $data)
    {
        return ProductVariant::create($data);
    }

    public function update(array $data, string $id)
    {
        $variant = ProductVariant::findOrFail($id);
        $variant->update($data);
        return $variant;
    }

    public function delete($id)
    {
        return ProductVariant::findOrFail($id)->delete();
    }

    public function updateStatus($data, $id)
    {
        return ProductVariant::find($id)->update($data);
    }
}
