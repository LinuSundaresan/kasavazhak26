<?php

namespace App\Repositories;

use App\Models\FlashSale;
use App\Interfaces\FlashSaleRepositoryInterface;

class FlashSaleRepository implements FlashSaleRepositoryInterface
{
    public function first()
    {
        return FlashSale::first();
    }

    public function getFlashSaleDate()
    {
        return FlashSale::first();
    }

    public function updateOrCreate(array $attributes, array $values)
    {
        return FlashSale::updateOrCreate($attributes, $values);
    }

    public function update(array $data, string $id)
    {
        return FlashSale::updateOrCreate(['id' => $id], $data);
    }
}
