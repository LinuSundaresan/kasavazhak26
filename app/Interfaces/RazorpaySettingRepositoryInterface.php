<?php

namespace App\Interfaces;

interface RazorpaySettingRepositoryInterface
{
    public function getRazorpaySetting();
    public function first();
    public function updateOrCreate(array $attributes, array $values);
}
