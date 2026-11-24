<?php

namespace App\Interfaces;

interface CategoryRepositoryInterface
{
    public function getAll();
    public function getActiveCategories();
    public function getById(string $id);
    public function getBySlug(string $slug);
    public function create(array $data);
    public function update(array $data, string $id);
    public function delete($id);
    public function updateStatus($data, $id);
}
