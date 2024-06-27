<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = \Request::segment(2);
        return [
            'category_id' => 'required',
            'supplier_id' => 'required',
            'name' => 'required',
            'code' => "required|unique:products,code,{$id},id|max:255",
            'garage' => 'required',
            'route' => 'required',
            'buying_price' => 'required',
            'selling_price' => 'required',
            'buying_date' => 'required',
            'expire_date' => 'required',
            'status' => 'required',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ];
    }

    public function messages()
    {
        return [
            'category_id.required' => 'The Category field is required.',
            'supplier_id.required' => 'The Supplier field is required.',
            'name.required' => 'The Name field is required.',
            'code.required' => 'The Code field is required.',
            'code.unique' => 'The Code has already been taken.',
            'garage.required' => 'The Garage field is required.',
            'route.required' => 'The Route field is required.',
            'buying_price.required' => 'The Buying Price field is required.',
            'selling_price.required' => 'The Selling Price field is required.',
            'expire_date.required' => 'The Expire Date field is required.'
        ];
    }
}
