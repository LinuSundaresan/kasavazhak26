<?php

namespace App\Interfaces;

interface FlashSaleRepositoryInterface
{
    public function first();
    public function getFlashSaleDate();
    public function updateOrCreate(array $attributes, array $values);
    public function update(array $data, string $id);
}
