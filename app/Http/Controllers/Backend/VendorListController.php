<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\VendorListDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class VendorListController extends Controller
{
    public function index(VendorListDataTable $dataTable)
    {
        return $dataTable->render('admin.vendor-list.index');
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status == 'true' ? 'active' : 'inactive';
        app(UserRepositoryInterface::class)->updateStatus($status, $request->id);

        return response(['message' => 'Status has been updated!']);
    }
}
