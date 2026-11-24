<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\CustomerListDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\UserRepositoryInterface;
use Illuminate\Http\Request;

class CustomerListController extends Controller
{
    public function index(CustomerListDataTable $dataTable)
    {
        return $dataTable->render('admin.customer-list.index');
    }

    public function changeStatus(Request $request)
    {
        $status = $request->status == 'true' ? 'active' : 'inactive';
        app(UserRepositoryInterface::class)->updateStatus($status, $request->id);

        return response(['message' => 'Status has been updated!']);
    }
}
