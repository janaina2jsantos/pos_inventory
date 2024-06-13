<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdvanceSalaryRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'employee_id' => 'required',
            'advance_salary' => 'required',
            'month' => 'required|date'
        ];
    }

    public function messages()
    {
        return [
            'employee_id.required' => 'The Employee field is required.',
            'advance_salary.required' => 'The Advance Salary field is required.',
            'month.required' => 'The Month field is required.'
        ];
    }
}
