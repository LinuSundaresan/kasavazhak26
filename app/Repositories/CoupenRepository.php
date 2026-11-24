<?php

namespace App\Repositories;

use App\Models\Coupon;
use App\Interfaces\CoupenRepositoryInterface;

class CoupenRepository implements CoupenRepositoryInterface
{
    public function getAll()
    {
        return Coupon::all();
    }

    public function getById(string $id)
    {
        return Coupon::findOrFail($id);
    }

    public function getByCode(string $code)
    {
        return Coupon::where('code', $code)->where('status', 1)->first();
    }

    public function create(array $data)
    {
        return Coupon::create($data);
    }

    public function update(array $data, string $id)
    {
        $coupon = Coupon::findOrFail($id);
        $coupon->update($data);
        return $coupon;
    }

    public function delete($id)
    {
        return Coupon::findOrFail($id)->delete();
    }

    public function updateStatus($data, $id)
    {
        return Coupon::find($id)->update($data);
    }
}
