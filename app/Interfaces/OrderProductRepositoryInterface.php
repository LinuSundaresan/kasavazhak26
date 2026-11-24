<?php

namespace App\Interfaces;

interface OrderProductRepositoryInterface
{
    public function create(array $data);
    public function getByOrderId($orderId);
    public function getByProductId($productId);
    public function deleteByOrderId($orderId);
}
