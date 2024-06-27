<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = \Request::segment(2);
        return [
            'name' => "required|unique:categories,name,{$id},id|min:5"
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Name field is required.',
            'name.unique' => 'The Name has already been taken.'
        ];
    }
}