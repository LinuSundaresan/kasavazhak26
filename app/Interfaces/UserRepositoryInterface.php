<?php

namespace App\Interfaces;

interface UserRepositoryInterface
{
    public function getAll();
    public function getById(string $id);
    public function getByRole(string $role);
    public function create(array $data);
    public function update(array $data, string $id);
    public function delete($id);
    public function updateStatus($status, $id);
    public function updateRole($role, $id);
}
