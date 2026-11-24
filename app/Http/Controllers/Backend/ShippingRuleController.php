<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\ShippingRuleDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\ShippingruleRepositoryInterface;
use Illuminate\Http\Request;

class ShippingRuleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ShippingRuleDataTable $dataTable)
    {
        return $dataTable->render('admin.shipping-rule.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.shipping-rule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'type' => ['required'],
            'min_cost' => ['nullable', 'integer'],
            'cost' => ['required', 'integer'],
            'status' => ['required']
        ]);

        $data = [
            'name' => $request->name,
            'type' => $request->type,
            'min_cost' => $request->min_cost,
            'cost' => $request->cost,
            'status' => $request->status,
        ];

        app(ShippingruleRepositoryInterface::class)->create($data);

        toastr('Created Successfully', 'success', 'Success');

        return redirect()->route('admin.shipping-rule.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $shipping = app(ShippingruleRepositoryInterface::class)->getById($id);
        return view('admin.shipping-rule.edit', compact('shipping'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'max:200'],
            'type' => ['required'],
            'min_cost' => ['nullable', 'integer'],
            'cost' => ['required', 'integer'],
            'status' => ['required']
        ]);

        $data = [
            'name' => $request->name,
            'type' => $request->type,
            'min_cost' => $request->min_cost,
            'cost' => $request->cost,
            'status' => $request->status,
        ];

        app(ShippingruleRepositoryInterface::class)->update($data, $id);

        toastr('Updated Successfully', 'success', 'Success');

        return redirect()->route('admin.shipping-rule.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        app(ShippingruleRepositoryInterface::class)->delete($id);

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function changeStatus(Request $request)
    {
        $status = ($request->status === 'true' || $request->status === true || $request->status == 1) ? 1 : 0;
        app(ShippingruleRepositoryInterface::class)->updateStatus(['status' => $status], $request->id);

        return response(['message' => 'Status has been updated!']);
    }

    public function updateStatus(Request $request)
    {
        return $this->changeStatus($request);
    }
}
