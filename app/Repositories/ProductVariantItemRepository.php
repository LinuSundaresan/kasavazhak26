<?php

namespace App\Repositories;

use App\Models\ProductVariantItem;
use App\Interfaces\ProductVariantItemRepositoryInterface;

class ProductVariantItemRepository implements ProductVariantItemRepositoryInterface
{
    public function create(array $data)
    {
        return ProductVariantItem::create($data);
    }

    public function getById(string $id)
    {
        return ProductVariantItem::findOrFail($id);
    }

    public function update(array $data, string $id )
    {
        ProductVariantItem::findOrFail($id)->update($data);
    }

    public function delete($id)
    {
        ProductVariantItem::findOrFail($id)->delete();
    }

    public function updateStatus( $data, $id )
    {
        ProductVariantItem::find($id)->update( $data );
    }

    public function getVariantItemCountByVariant($id)
    {
        return ProductVariantItem::where('product_variant_id', $id)->count();
    }
}
