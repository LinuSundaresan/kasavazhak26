<?php

namespace App\Repositories;

use App\Models\ShippingRule;
use App\Interfaces\ShippingruleRepositoryInterface;

class ShippingRuleRepository implements ShippingruleRepositoryInterface
{
    public function getAll()
    {
        return ShippingRule::all();
    }

    public function getActiveShippingRules()
    {
        return ShippingRule::where('status', 1)->get();
    }

    public function getById(string $id)
    {
        return ShippingRule::findOrFail($id);
    }

    public function create(array $data)
    {
        return ShippingRule::create($data);
    }

    public function update(array $data, string $id)
    {
        $shipping = ShippingRule::findOrFail($id);
        $shipping->update($data);
        return $shipping;
    }

    public function delete($id)
    {
        return ShippingRule::findOrFail($id)->delete();
    }

    public function updateStatus($data, $id)
    {
        return ShippingRule::find($id)->update($data);
    }
}
