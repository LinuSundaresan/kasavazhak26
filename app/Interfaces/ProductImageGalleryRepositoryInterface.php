<?php

namespace App\Interfaces;

interface ProductImageGalleryRepositoryInterface
{
    public function getAllGaleryByProductId($productId);
    public function getAllGalleryByProductId($productId);
    public function getById(string $id);
    public function create(array $data);
    public function delete($id);
}
