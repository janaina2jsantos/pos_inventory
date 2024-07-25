<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExpenseRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'details' => "required|min:10|max:255",
            'amount' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'details.required' => 'The Details field is required.',
            'amount.required' => 'The Amount field is required.'
        ];
    }
}
