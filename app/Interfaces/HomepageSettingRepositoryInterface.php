<?php

namespace App\Interfaces;

interface HomepageSettingRepositoryInterface
{
    public function getAll();
    public function getByKey(string $key);
    public function updateOrCreate(array $attributes, array $values);
}
