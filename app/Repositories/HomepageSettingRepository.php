<?php

namespace App\Repositories;

use App\Models\HomePageSetting;
use App\Interfaces\HomepageSettingRepositoryInterface;

class HomepageSettingRepository implements HomepageSettingRepositoryInterface
{
    public function getAll()
    {
        return HomePageSetting::all();
    }

    public function getByKey(string $key)
    {
        return HomePageSetting::where('key', $key)->first();
    }

    public function updateOrCreate(array $attributes, array $values)
    {
        return HomePageSetting::updateOrCreate($attributes, $values);
    }
}
