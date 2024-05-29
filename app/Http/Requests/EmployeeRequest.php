<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmployeeRequest extends FormRequest
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
        $id = \Request::segment(2);
        return [
            'name' => 'required',
            'email' => "required|unique:employees,email,{$id},id|max:255",
            'phone' => 'required',
            'zip' => 'required',
            'street' => 'required',
            'number' => 'required',
            'neighborhood' => 'required',
            'city' => 'required',
            'state' => 'required',
            'role' => 'required',
            'experience' => 'required',
            'nidno' => "required|unique:employees,nid_no,{$id},id|min:8|max:8",
            'salary' => 'required',
            'vacation' => 'required|date',
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
            'role.required' => 'The Role field is required.',
            'experience.required' => 'The Experience field is required.',
            'nidno.required' => 'The NID Number field is required.',
            'salary.required' => 'The Salary field is required.',
            'vacation.required' => 'The Vacation field is required.',
        ];
    }
}
