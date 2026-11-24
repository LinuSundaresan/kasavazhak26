<?php

namespace App\Interfaces;

interface SubCategoryRepositoryInterface
{
    public function getAll();
    public function getActiveSubCategories();
    public function getById(string $id);
    public function getBySlug(string $slug);
    public function getSubCategoryByCategoryId($categoryId);
    public function getActiveSubCategoryByCategoryId($categoryId);
    public function getSubCategoryCountByCategory($categoryId);
    public function create(array $data);
    public function update(array $data, string $id);
    public function delete($id);
    public function updateStatus($data, $id);
}
