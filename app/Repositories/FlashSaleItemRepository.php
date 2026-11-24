<?php

namespace App\Repositories;

use App\Models\FlashSaleItem;
use App\Interfaces\FlashSaleItemRepositoryInterface;

class FlashSaleItemRepository implements FlashSaleItemRepositoryInterface
{
    public function getAll()
    {
        return FlashSaleItem::all();
    }

    public function getById(string $id)
    {
        return FlashSaleItem::findOrFail($id);
    }

    public function getActiveFlashSaleProductIds()
    {
        return FlashSaleItem::where('status', 1)->orderBy('id', 'ASC')->pluck('product_id')->toArray();
    }

    public function getHomeFlashSaleProductIds()
    {
        return FlashSaleItem::where('show_at_home', 1)->where('status', 1)->pluck('product_id')->toArray();
    }

    public function create(array $data)
    {
        return FlashSaleItem::create($data);
    }

    public function delete($id)
    {
        return FlashSaleItem::findOrFail($id)->delete();
    }

    public function updateStatus($data, $id)
    {
        return FlashSaleItem::find($id)->update($data);
    }

    public function updateShowAtHomeStatus($data, $id)
    {
        return FlashSaleItem::find($id)->update($data);
    }
}
