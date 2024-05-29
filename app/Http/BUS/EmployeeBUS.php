<?php

namespace App\Http\BUS;

use App\Models\Employee;
use Exception;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EmployeeBUS
{
	public static function getEmployees(Request $request) {
		$employees = new Employee();
		if ($request->has("search")) {
			if ($request->word != "" || $request->status != "") {
				$employees = $employees->where("name", "LIKE", "%{$request->word}%")
					->where("status", "=", $request->status);
			}
			else {
				die();
			}
		}
		if ($request->has("status")) {
			if ($request->status != "") {
				$employees = $employees->where("status", "=", $request->status);
			}
		}
		if ($request->has("word")) {
			$employees = $employees->where('name', 'LIKE', '%' . $request->word . '%')
				->orWhere('email', 'LIKE', '%' . $request->word . '%')
				->orWhere('city', 'LIKE', '%' . $request->word . '%')
				->orWhere('role', 'LIKE', '%' . $request->word . '%');
		}
		return $employees;
	}

	public static function storeEmployee(EmployeeRequest $request) 
	{
		$salary = floatval(str_replace(['.', ','], ['', '.'], substr($request->salary, 10)));

		// upload
		if ((isset($_FILES['photo'])) && ($_FILES['photo']['type'] != "")) {
			if(!is_dir("dist/assets/img/employees/")) {
				mkdir("dist/assets/img/employees/");
			}

			$file = $_FILES['photo'];
			if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
				$uploaded = "dist/assets/img/employees/". $_FILES["photo"]["name"]; 
				move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded);
			}
		}

		$employee = Employee::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'zip' => $request->zip,
            'address' => $request->street,
            'number' => $request->number,
            'complement' => $request->complement,
            'neighborhood' => $request->neighborhood,
            'city' => $request->city,
            'state' => $request->state,
            'role' => $request->role,
            'experience' => $request->experience,
            'nid_no' => $request->nidno,
            'photo' => isset($uploaded) ? "/".$uploaded : null,
            'salary' => $salary,
            'vacation' => $request->vacation,
            'status' => $request->status
        ]);

		return $employee;
	}
	
	public static function updateEmployee(EmployeeRequest $request, $id) 
	{
		$salary = floatval(str_replace(['.', ','], ['', '.'], substr($request->salary, 10)));
		$employee = Employee::findOrFail($id);

		// upload
		if ((isset($_FILES['photo'])) && ($_FILES['photo']['type'] != "")) {
	        if ($employee->photo) {
				// delete the old photo if it exists
	        	if (\File::exists(public_path($employee->photo))) {
	        		\File::delete(public_path($employee->photo));
	        	}
	        }

			$file = $_FILES['photo'];
			if ($file['type'] == 'image/jpeg' || $file['type'] == 'image/jpg' || $file['type'] == 'image/png') {
				$uploaded = "dist/assets/img/employees/". $_FILES["photo"]["name"]; 
				move_uploaded_file($_FILES['photo']['tmp_name'], $uploaded);
			}
		}

		$employee->update([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'zip' => $request->input('zip'),
            'address' => $request->input('street'),
            'number' => $request->input('number'),
            'complement' => isset($request->complement) ? $request->input('complement') : $employee->complement,
            'neighborhood' => $request->input('neighborhood'),
            'city' => $request->input('city'),
            'state' => $request->input('state'),
            'role' => $request->input('role'),
            'experience' => $request->input('experience'),
            'nid_no' => $request->input('nidno'),
            'photo' => isset($uploaded) ? "/" . $uploaded : $employee->photo,
            'salary' => $salary,
            'vacation' => $request->input('vacation'),
            'status' => $request->input('status')
        ]);

		return $employee;
	}

	public static function destroyEmployee($id) 
	{
		try {
            $employee = Employee::findOrFail($id);
			// delete the employee photo if it exists
            if ($employee->photo) {
	        	if (\File::exists(public_path($employee->photo))) {
	        		\File::delete(public_path($employee->photo));
	        	}
	        }
            $employee->delete();
            return true;
        }
        catch(Exception $ex) {
            return false;
        }
	}
}