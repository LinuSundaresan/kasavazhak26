<?php

namespace App\Repositories;

use App\Models\Order;
use App\Interfaces\OrderRepositoryInterface;

class OrderRepository implements OrderRepositoryInterface
{
    public function getAll()
    {
        return Order::all();
    }

    public function getById(string $id)
    {
        return Order::findOrFail($id);
    }

    public function getByInvoiceId(string $invoiceId)
    {
        return Order::where('invocie_id', $invoiceId)->first();
    }

    public function getByUserId($userId)
    {
        return Order::where('user_id', $userId)->orderBy('id', 'DESC')->get();
    }

    public function countByUserId($userId)
    {
        return Order::where('user_id', $userId)->count();
    }

    public function countByUserIdAndStatus($userId, string $status)
    {
        return Order::where('user_id', $userId)->where('order_status', $status)->count();
    }

    public function create(array $data)
    {
        return Order::create($data);
    }

    public function update(array $data, string $id)
    {
        $order = Order::findOrFail($id);
        $order->update($data);
        return $order;
    }

    public function delete($id)
    {
        return Order::findOrFail($id)->delete();
    }

    public function updateOrderStatus($status, $id)
    {
        return Order::where('id', $id)->update(['order_status' => $status]);
    }

    public function updatePaymentStatus($status, $id)
    {
        return Order::where('id', $id)->update(['payment_status' => $status]);
    }
}
