<?php

namespace App\Repositories;

use App\Models\PaypalSetting;
use App\Interfaces\PaypalSettingRepositoryInterface;

class PaypalSettingRepository implements PaypalSettingRepositoryInterface
{
    public function getPaypalSetting()
    {
        return PaypalSetting::first();
    }

    public function first()
    {
        return PaypalSetting::first();
    }

    public function updateOrCreate(array $attributes, array $values)
    {
        return PaypalSetting::updateOrCreate($attributes, $values);
    }
}
