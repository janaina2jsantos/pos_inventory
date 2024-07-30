<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CompanyRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $id = \Request::segment(2);
        return [
            'company_name' => 'required',
            'company_email' => "required|unique:employees,email,{$id},id|max:255",
            'company_phone' => 'required',
            'company_zip' => 'required',
            'company_address' => 'required',
            'company_number' => 'required',
            'company_neighborhood' => 'required',
            'company_city' => 'required',
            'company_state' => 'required',
            'company_logo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];
    }

    public function messages()
    {
        return [
            'company_name.required' => 'The Company Name is required.',
            'company_email.required' => 'The Email field is required.',
            'company_phone.required' => 'The Phone field is required.',
            'company_zip.required' => 'The ZIP Code field is required.',
            'company_street.required' => 'The Street field is required.',
            'company_number.required' => 'The Number field is required.',
            'company_neighborhood.required' => 'The Neighborhood field is required.',
            'company_city.required' => 'The City field is required.',
            'company_state.required' => 'The State field is required.',
        ];
    }
}
