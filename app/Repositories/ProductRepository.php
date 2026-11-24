<?php

namespace App\Repositories;

use App\Models\Product;
use App\Interfaces\ProductRepositoryInterface;

class ProductRepository implements ProductRepositoryInterface
{
    public function create(array $data)
    {
        return Product::create($this->formatData($data));
    }

    public function getAll()
    {
        return Product::all();
    }

    public function getActiveProducts()
    {
        return Product::where('is_approved', 1)->where('status', 1)->orderBy('id', 'DESC')->get();
    }

    public function getById($id)
    {
        return Product::findOrFail($id);
    }

    public function getBySlug($slug)
    {
        return Product::with(['vendor', 'category' , 'variants' , 'galleryImages', 'brand'])->where('slug', $slug)->where('status', 1)->first();
    }

    public function update($data , $id)
    {
        $product = Product::findOrFail($id);
        $product->update($this->formatData($data));
        return $product;
    }

    public function delete($id)
    {
        Product::findOrFail($id)->delete();
    }

    public function updateStatus( $data, $id )
    {
        Product::find($id)->update( $data );
    }

    public function updateApproval($data , $id)
    {
        $product = Product::find($id);
        $product->update($data);
    }

    public function getTypeBasedProducts(string $type)
    {
        return Product::withAvg('reviews', 'rating')->withCount('reviews')
            ->with(['variants', 'category', 'productImageGalleries'])
            ->where(['product_type'=> $type , 'is_approved'=>1, 'status'=>1])
            ->orderBy('id', 'DESC')->take(8)->get();
    }

    protected function formatData(array $data): array
    {
        if (isset($data['category']) && !isset($data['category_id'])) {
            $data['category_id'] = $data['category'];
            unset($data['category']);
        }
        if (isset($data['sub_category']) && !isset($data['sub_category_id'])) {
            $data['sub_category_id'] = $data['sub_category'];
            unset($data['sub_category']);
        }
        if (isset($data['child_category']) && !isset($data['child_category_id'])) {
            $data['child_category_id'] = $data['child_category'];
            unset($data['child_category']);
        }
        if (isset($data['brand']) && !isset($data['brand_id'])) {
            $data['brand_id'] = $data['brand'];
            unset($data['brand']);
        }
        unset($data['image']);
        return $data;
    }
}
