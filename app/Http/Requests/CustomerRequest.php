<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = \Request::segment(2);
        return [
            'name' => 'required',
            'email' => "required|unique:customers,email,{$id},id|max:255",
            'phone' => 'required',
            'zip' => 'required',
            'street' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'shop_name' => 'required',
            'account_number' => "nullable|unique:customers,account_number,{$id},id|max:9",
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The Name field is required.',
            'email.required' => 'The Email field is required.',
            'email.unique' => 'The Email has already been taken.',
            'phone.required' => 'The Phone field is required.',
            'zip.required' => 'The ZIP Code field is required.',
            'street.required' => 'The Street field is required.',
            'number.required' => 'The Number field is required.',
            'neighborhood.required' => 'The Neighborhood field is required.',
            'city.required' => 'The City field is required.',
            'state.required' => 'The State field is required.',
            'shop_name.required' => 'The Shop Name field is required.',
            'account_number.unique' => 'The Account Number has already been taken.',
            'photo.mimes' => 'The image is not valid.'
        ];
    }
}
