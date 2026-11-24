<?php

namespace App\Interfaces;

interface FlashSaleItemRepositoryInterface
{
    public function getAll();
    public function getById(string $id);
    public function getActiveFlashSaleProductIds();
    public function getHomeFlashSaleProductIds();
    public function create(array $data);
    public function delete($id);
    public function updateStatus($data, $id);
    public function updateShowAtHomeStatus($data, $id);
}
