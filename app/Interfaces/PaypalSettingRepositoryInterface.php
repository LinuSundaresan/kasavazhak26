<?php

namespace App\Interfaces;

interface PaypalSettingRepositoryInterface
{
    public function getPaypalSetting();
    public function first();
    public function updateOrCreate(array $attributes, array $values);
}
