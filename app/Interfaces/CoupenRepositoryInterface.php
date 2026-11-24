<?php

namespace App\Interfaces;

interface CoupenRepositoryInterface
{
    public function getAll();
    public function getById(string $id);
    public function getByCode(string $code);
    public function create(array $data);
    public function update(array $data, string $id);
    public function delete($id);
    public function updateStatus($data, $id);
}
