<?php

namespace App\Interfaces;

interface SliderRepositoryInterface
{
    public function getAll();
    public function getActiveSliders();
    public function getById(string $id);
    public function create(array $data);
    public function update(array $data, string $id);
    public function delete($id);
}
