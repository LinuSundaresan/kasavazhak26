<?php

namespace App\Http\Controllers\Backend;

use App\DataTables\SliderDataTable;
use App\Http\Controllers\Controller;
use App\Interfaces\SliderRepositoryInterface;
use App\Traits\ImageUploadTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SliderController extends Controller
{
    use ImageUploadTrait;

    /**
     * Display a listing of the resource.
     */
    public function index(SliderDataTable $dataTable)
    {
        return $dataTable->render('admin.slider.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.slider.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       $request->validate([
            'banner' => ['required','image', 'max:2000'],
            'type' => ['string', 'max:200'],
            'title' => ['required','max:200'],
            'starting_price' => ['max:200'],
            'btn_url' => ['url'],
            'serial' => ['required', 'integer'],
            'status' => ['required']
       ]);

       /** Handle file upload */
       $imagePath = $this->uploadImage($request, 'banner', 'uploads');

       $data = [
           'banner' => $imagePath,
           'type' => $request->type,
           'title' => $request->title,
           'starting_price' => $request->starting_price,
           'btn_url' => $request->btn_url,
           'serial' => $request->serial,
           'status' => $request->status,
       ];

       app(SliderRepositoryInterface::class)->create($data);

       Cache::forget('sliders');

       toastr('Created Successfully!', 'success');

       return redirect()->back();
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
        $slider = app(SliderRepositoryInterface::class)->getById($id);
        return view('admin.slider.edit', compact('slider'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'banner' => ['nullable','image', 'max:2000'],
            'type' => ['string', 'max:200'],
            'title' => ['required','max:200'],
            'starting_price' => ['max:200'],
            'btn_url' => ['url'],
            'serial' => ['required', 'integer'],
            'status' => ['required']
       ]);

       $slider = app(SliderRepositoryInterface::class)->getById($id);

       /** Handle file upload */
       $imagePath = $this->updateImage($request, 'banner', 'uploads', $slider->banner);

       $data = [
           'banner' => empty(!$imagePath) ? $imagePath : $slider->banner,
           'type' => $request->type,
           'title' => $request->title,
           'starting_price' => $request->starting_price,
           'btn_url' => $request->btn_url,
           'serial' => $request->serial,
           'status' => $request->status,
       ];

       app(SliderRepositoryInterface::class)->update($data, $id);

       Cache::forget('sliders');

       toastr('Updated Successfully!', 'success');

       return redirect()->route('admin.slider.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $slider = app(SliderRepositoryInterface::class)->getById($id);
        $this->deleteImage($slider->banner);
        app(SliderRepositoryInterface::class)->delete($id);

        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }
}
