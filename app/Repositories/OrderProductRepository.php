<?php

namespace App\Repositories;

use App\Models\OrderProduct;
use App\Interfaces\OrderProductRepositoryInterface;

class OrderProductRepository implements OrderProductRepositoryInterface
{
    public function create(array $data)
    {
        return OrderProduct::create($data);
    }

    public function getByOrderId($orderId)
    {
        return OrderProduct::where('order_id', $orderId)->get();
    }

    public function getByProductId($productId)
    {
        return OrderProduct::where('product_id', $productId)->get();
    }

    public function deleteByOrderId($orderId)
    {
        return OrderProduct::where('order_id', $orderId)->delete();
    }
}
