<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\FlashSaleItemDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\FlashSaleItemRepositoryInterface;
use App\Interfaces\FlashSaleRepositoryInterface;
use App\Interfaces\ProductRepositoryInterface;
use Illuminate\Http\Request;

class FlashSaleController extends Controller
{
    public function index(FlashSaleItemDataTable $dataTable)
    {
        $flashSaleDate = app(FlashSaleRepositoryInterface::class)->getFlashSaleDate();
        $products = app(ProductRepositoryInterface::class)->getActiveProducts();
        return $dataTable->render('admin.flash-sale.index', compact('flashSaleDate', 'products'));
    }

    public function update(Request $request)
    {
       $request->validate([
        'end_date' => ['required']
       ]);

       app(FlashSaleRepositoryInterface::class)->updateOrCreate(
            ['id' => 1],
            ['end_date' => $request->end_date]
       );

       toastr('Updated Successfully!', 'success', 'Success');

       return redirect()->back();
    }

    public function addProduct(Request $request)
    {
        $request->validate([
            'product' => ['required', 'unique:flash_sale_items,product_id'],
            'show_at_home' => ['required'],
            'status' => ['required'],
        ],[
            'product.unique' => 'The product is already in flash sale!'
        ]);

        $flashSaleDate = app(FlashSaleRepositoryInterface::class)->getFlashSaleDate();

        $data = [
            'product_id' => $request->product,
            'flash_sale_id' => $flashSaleDate->id,
            'show_at_home' => $request->show_at_home,
            'status' => $request->status,
        ];

        app(FlashSaleItemRepositoryInterface::class)->create($data);

        toastr('Product Added Successfully!', 'success', 'Success');

        return redirect()->back();
    }

    public function chageShowAtHomeStatus(Request $request)
    {
        $status = ($request->status === 'true' || $request->status === true || $request->status == 1) ? 1 : 0;
        app(FlashSaleItemRepositoryInterface::class)->updateShowAtHomeStatus(['show_at_home' => $status], $request->id);

        return response(['message' => 'Status has been updated!']);
    }

    public function changeShowAtHomeStatus(Request $request)
    {
        return $this->chageShowAtHomeStatus($request);
    }

    public function changeStatus(Request $request)
    {
        $status = ($request->status === 'true' || $request->status === true || $request->status == 1) ? 1 : 0;
        app(FlashSaleItemRepositoryInterface::class)->updateStatus(['status' => $status], $request->id);

        return response(['message' => 'Status has been updated!']);
    }

    public function updateStatus(Request $request)
    {
        return $this->changeStatus($request);
    }

    public function destory(string $id)
    {
        app(FlashSaleItemRepositoryInterface::class)->delete($id);
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function destroy(string $id)
    {
        return $this->destory($id);
    }
}
