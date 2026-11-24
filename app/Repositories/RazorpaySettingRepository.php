<?php

namespace App\Repositories;

use App\Models\RazorpaySetting;
use App\Interfaces\RazorpaySettingRepositoryInterface;

class RazorpaySettingRepository implements RazorpaySettingRepositoryInterface
{
    public function getRazorpaySetting()
    {
        return RazorpaySetting::first();
    }

    public function first()
    {
        return RazorpaySetting::first();
    }

    public function updateOrCreate(array $attributes, array $values)
    {
        return RazorpaySetting::updateOrCreate($attributes, $values);
    }
}
