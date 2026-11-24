<?php

namespace App\Interfaces;

interface UserAddressRepositoryInterface
{
    public function getAllByUserId($userId);
    public function getById(string $id);
    public function create(array $data);
    public function update(array $data, string $id);
    public function delete($id);
}
