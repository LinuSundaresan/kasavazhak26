<?php

namespace App\Interfaces;

interface StripeSettingRepositoryInterface
{
    public function getStripeSetting();
    public function first();
    public function updateOrCreate(array $attributes, array $values);
}
