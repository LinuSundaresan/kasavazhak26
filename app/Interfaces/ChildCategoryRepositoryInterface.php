<?php

namespace App\Interfaces;

interface ChildCategoryRepositoryInterface
{
    public function getAll();
    public function getById(string $id);
    public function getBySlug(string $slug);
    public function getChildCategoryBySubCategoryId($subCategoryId);
    public function getActiveChildCategoryBySubCategoryId($subCategoryId);
    public function getChildCategoryCountBySubCategory($subCategoryId);
    public function create(array $data);
    public function update(array $data, string $id);
    public function delete($id);
    public function updateStatus($data, $id);
}
