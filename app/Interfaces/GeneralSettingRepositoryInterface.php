<?php

namespace App\Interfaces;

interface GeneralSettingRepositoryInterface
{
    public function getGeneralSetting();
    public function updateOrCreate(array $attributes, array $values);
    public function update(array $data, string $id);
}
