<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorRequestDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use App\Interfaces\VendorShopProfileRepositoryInterface;
use Illuminate\Http\Request;

class VendorRequestController extends Controller
{
    public function index(VendorRequestDataTable $dataTable)
    {
        return $dataTable->render('admin.vendor-request.index');
    }

    public function show(string $id)
    {
        $vendor = app(VendorShopProfileRepositoryInterface::class)->getById($id);
        return view('admin.vendor-request.show', compact('vendor'));
    }

    public function changeStatus(Request $request, string $id)
    {
        $vendorRepo = app(VendorShopProfileRepositoryInterface::class);
        $vendor = $vendorRepo->getById($id);
        $vendorRepo->update(['status' => $request->status], $id);

        app(UserRepositoryInterface::class)->updateRole('vendor', $vendor->user_id);

        toastr('Updated successfully!', 'success', 'success');
        return redirect()->route('admin.vendor-requests.index');
    }
}
