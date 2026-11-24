<?php

namespace App\Interfaces;

interface TransactionRepositoryInterface
{
    public function create(array $data);
    public function getByOrderId($orderId);
    public function deleteByOrderId($orderId);
}
