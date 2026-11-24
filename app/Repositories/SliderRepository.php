<?php

namespace App\Repositories;

use App\Models\Slider;
use App\Interfaces\SliderRepositoryInterface;

class SliderRepository implements SliderRepositoryInterface
{
    public function getAll()
    {
        return Slider::all();
    }

    public function getActiveSliders()
    {
        return Slider::where('status', 1)->orderBy('serial', 'asc')->get();
    }

    public function getById(string $id)
    {
        return Slider::findOrFail($id);
    }

    public function create(array $data)
    {
        return Slider::create($data);
    }

    public function update(array $data, string $id)
    {
        $slider = Slider::findOrFail($id);
        $slider->update($data);
        return $slider;
    }

    public function delete($id)
    {
        return Slider::findOrFail($id)->delete();
    }
}
