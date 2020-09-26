<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $product = $this->route('product');

        return [
            'name' => 'required|string|max:45|unique:products,name, '.$product->name,
            'description' => 'required',
            'price' => 'required|numeric|max:999999.99'
        ];
    }
}
