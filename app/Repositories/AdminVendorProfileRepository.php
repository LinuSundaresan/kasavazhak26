<?php

namespace App\Repositories;

use App\Models\Vendor;
use App\Interfaces\AdminVendorProfileRepositoryInterface;

class AdminVendorProfileRepository implements AdminVendorProfileRepositoryInterface
{
    public function getProfileByUserId($userId)
    {
        return Vendor::where('user_id', $userId)->first();
    }

    public function updateOrCreate(array $attributes, array $values)
    {
        return Vendor::updateOrCreate($attributes, $values);
    }

    public function updateByUserId(array $data, $userId)
    {
        $vendor = Vendor::where('user_id', $userId)->first();
        if ($vendor) {
            $vendor->update($data);
        }
        return $vendor;
    }

    public function getById(string $id)
    {
        return Vendor::findOrFail($id);
    }

    public function create(array $data)
    {
        return Vendor::create($data);
    }

    public function update(array $data, string $id)
    {
        $vendor = Vendor::findOrFail($id);
        $vendor->update($data);
        return $vendor;
    }
}
