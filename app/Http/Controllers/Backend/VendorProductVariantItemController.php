<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorProductVariantItemDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\ProductRepositoryInterface;
use App\Interfaces\ProductVariantItemRepositoryInterface;
use App\Interfaces\ProductVariantRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class VendorProductVariantItemController extends Controller
{
    public function index(VendorProductVariantItemDataTable $dataTable, $productId, $variantId)
    {
        $product = app(ProductRepositoryInterface::class)->getById($productId);
        $variant = app(ProductVariantRepositoryInterface::class)->getById($variantId);
        return $dataTable->render('vendor.product.product-variant-item.index', compact('product', 'variant'));
    }

    public function create(string $productId, string $variantId)
    {
        $variant = app(ProductVariantRepositoryInterface::class)->getById($variantId);
        $product = app(ProductRepositoryInterface::class)->getById($productId);
        return view('vendor.product.product-variant-item.create', compact('variant', 'product'));
    }

    /** Store data */
    public function store(Request $request)
    {
        $request->validate([
            'variant_id' => ['integer', 'required'],
            'name' => ['required', 'max:200'],
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $data = [
            'product_variant_id' => $request->variant_id,
            'name' => $request->name,
            'price' => $request->price,
            'is_default' => $request->is_default,
            'status' => $request->status,
        ];

        app(ProductVariantItemRepositoryInterface::class)->create($data);

        toastr('Created Successfully!', 'success', 'success');

        return redirect()->route('vendor.products-variant-item.index',
        ['productId' => $request->product_id, 'variantId' => $request->variant_id]);
    }

    public function edit(string $variantItemId)
    {
        $variantItem = app(ProductVariantItemRepositoryInterface::class)->getById($variantItemId);
        return view('vendor.product.product-variant-item.edit', compact('variantItem'));
    }

    public function update(Request $request, string $variantItemId)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'price' => ['integer', 'required'],
            'is_default' => ['required'],
            'status' => ['required']
        ]);

        $data = [
            'name' => $request->name,
            'price' => $request->price,
            'is_default' => $request->is_default,
            'status' => $request->status,
        ];

        app(ProductVariantItemRepositoryInterface::class)->update($data, $variantItemId);
        $variantItem = app(ProductVariantItemRepositoryInterface::class)->getById($variantItemId);

        toastr('Update Successfully!', 'success', 'success');

        return redirect()->route('vendor.products-variant-item.index',
        ['productId' => $variantItem->productVariant->product_id, 'variantId' => $variantItem->product_variant_id]);
    }

    public function destroy(string $variantItemId)
    {
        app(ProductVariantItemRepositoryInterface::class)->delete($variantItemId);

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function chageStatus(Request $request)
    {
        $status = $request->status == 'true' ? 1 : 0;
        app(ProductVariantItemRepositoryInterface::class)->updateStatus(['status' => $status], $request->id);

        return response(['message' => 'Status has been updated!']);
    }

    public function changeStatus(Request $request)
    {
        return $this->chageStatus($request);
    }

    public function updateStatus(Request $request)
    {
        return $this->chageStatus($request);
    }
}
