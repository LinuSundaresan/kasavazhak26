<?php

namespace App\Interfaces;

interface ShippingruleRepositoryInterface
{
    public function getAll();
    public function getActiveShippingRules();
    public function getById(string $id);
    public function create(array $data);
    public function update(array $data, string $id);
    public function delete($id);
    public function updateStatus($data, $id);
}
