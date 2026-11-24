<?php

namespace App\Repositories;

use App\Models\Transaction;
use App\Interfaces\TransactionRepositoryInterface;

class TransactionRepository implements TransactionRepositoryInterface
{
    public function create(array $data)
    {
        return Transaction::create($data);
    }

    public function getByOrderId($orderId)
    {
        return Transaction::where('order_id', $orderId)->first();
    }

    public function deleteByOrderId($orderId)
    {
        return Transaction::where('order_id', $orderId)->delete();
    }
}
