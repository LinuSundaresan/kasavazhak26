<?php

namespace App\Repositories;

use App\Models\StripeSetting;
use App\Interfaces\StripeSettingRepositoryInterface;

class StripeSettingRepository implements StripeSettingRepositoryInterface
{
    public function getStripeSetting()
    {
        return StripeSetting::first();
    }

    public function first()
    {
        return StripeSetting::first();
    }

    public function updateOrCreate(array $attributes, array $values)
    {
        return StripeSetting::updateOrCreate($attributes, $values);
    }
}
