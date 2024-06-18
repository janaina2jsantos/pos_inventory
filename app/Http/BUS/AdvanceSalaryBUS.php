<?php

namespace App\Http\BUS;

use App\Models\AdvanceSalary;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Requests\AdvanceSalaryRequest;
use Exception;

class AdvanceSalaryBUS
{
	public static function getAdvanceSalaries(Request $request) {
		$advSalaries = new AdvanceSalary();
		if ($request->has("search")) {
			if ($request->word != "") {
				$advSalaries = $advSalaries->whereHas("employee", function($w) use($request) {
	                $w->where("name", "LIKE", "%{$request->word}%");
	            });
			}
			else {
				die();
			}
		}
		if ($request->has("month")) {
			$advSalaries = $advSalaries->where("month", "LIKE", "%{$request->month}%");
		}
		if ($request->has("word")) {
			$advSalaries = $advSalaries->whereHas("employee", function($w) use($request) {
                $w->where("name", "LIKE", "%{$request->word}%");
            });
		}
		return $advSalaries;
	}

	public static function storeAdvanceSalary(AdvanceSalaryRequest $request) 
	{
		$payment = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', $request->advance_salary)));
		$hasAdvSalary = AdvanceSalary::where("month", "LIKE", "%{$request->month}%")
			->where("employee_id", $request->employee_id)
			->first();

		// checking if employee already has an advance registered in the provided month
		if ($hasAdvSalary === null) {
			$advSalary = AdvanceSalary::create([
	            'employee_id' => $request->employee_id,
	            'advance_salary' => $payment,
	            'month' => $request->month
	        ]);

			return $advSalary;
		}
	}
	
	public static function updateAdvanceSalary(AdvanceSalaryRequest $request, $id) 
	{
		$advSalary = AdvanceSalary::findOrFail($id);
		$payment = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', $request->input('advance_salary'))));

		$advSalary->update([
            'employee_id' => $request->input('employee_id'),
            'advance_salary' => $payment,
            'month' => $request->input('month')
        ]);

		return $advSalary;
	}

	public static function destroyAdvanceSalary($id) 
	{
		try {
            $advSalary = AdvanceSalary::findOrFail($id);
            $advSalary->delete();
            return true;
        }
        catch(Exception $ex) {
            return false;
        }
	}
}
