<?php

namespace App\Repositories;

use App\Models\UserAddress;
use App\Interfaces\UserAddressRepositoryInterface;

class UserAddressRepository implements UserAddressRepositoryInterface
{
    public function getAllByUserId($userId)
    {
        return UserAddress::where('user_id', $userId)->get();
    }

    public function getById(string $id)
    {
        return UserAddress::findOrFail($id);
    }

    public function create(array $data)
    {
        return UserAddress::create($data);
    }

    public function update(array $data, string $id)
    {
        $address = UserAddress::findOrFail($id);
        $address->update($data);
        return $address;
    }

    public function delete($id)
    {
        return UserAddress::findOrFail($id)->delete();
    }
}
