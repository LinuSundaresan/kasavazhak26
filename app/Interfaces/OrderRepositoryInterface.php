<?php

namespace App\Interfaces;

interface OrderRepositoryInterface
{
    public function getAll();
    public function getById(string $id);
    public function getByInvoiceId(string $invoiceId);
    public function getByUserId($userId);
    public function countByUserId($userId);
    public function countByUserIdAndStatus($userId, string $status);
    public function create(array $data);
    public function update(array $data, string $id);
    public function delete($id);
    public function updateOrderStatus($status, $id);
    public function updatePaymentStatus($status, $id);
}
