<?php

namespace App\Repositories;

use App\Models\GeneralSetting;
use App\Interfaces\GeneralSettingRepositoryInterface;

class GeneralSettingRepository implements GeneralSettingRepositoryInterface
{
    public function getGeneralSetting()
    {
        return GeneralSetting::first();
    }

    public function updateOrCreate(array $attributes, array $values)
    {
        return GeneralSetting::updateOrCreate($attributes, $values);
    }

    public function update(array $data, string $id)
    {
        return GeneralSetting::updateOrCreate(['id' => $id], $data);
    }
}
