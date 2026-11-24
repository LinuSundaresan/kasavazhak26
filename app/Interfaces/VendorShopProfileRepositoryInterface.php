<?php

namespace App\Interfaces;

interface VendorShopProfileRepositoryInterface
{
    public function getProfileByUserId($userId);
    public function updateOrCreate(array $attributes, array $values);
    public function updateByUserId(array $data, $userId);
    public function getById(string $id);
    public function create(array $data);
    public function update(array $data, string $id);
}
