<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'image' => ['nullable', 'image', 'max:3000'],
            'thumb_image' => ['nullable'],
            'name' => ['required', 'max:200'],
            'category' => ['nullable'],
            'category_id' => ['nullable'],
            'sub_category' => ['nullable'],
            'sub_category_id' => ['nullable'],
            'child_category' => ['nullable'],
            'child_category_id' => ['nullable'],
            'brand' => ['nullable'],
            'brand_id' => ['nullable'],
            'price' => ['required'],
            'qty' => ['required'],
            'short_description' => ['required', 'max:600'],
            'long_description' => ['required'],
            'video_link' => ['nullable'],
            'sku' => ['nullable'],
            'offer_price' => ['nullable'],
            'offer_start_date' => ['nullable'],
            'offer_end_date' => ['nullable'],
            'product_type' => ['nullable'],
            'seo_title' => ['nullable', 'max:200'],
            'seo_description' => ['nullable', 'max:250'],
            'status' => ['required'],
        ];
    }
}
