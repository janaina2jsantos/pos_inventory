<?php

namespace App\Http\BUS;

use App\Models\Expense;
use Illuminate\Http\Request;
use App\Http\Requests\ExpenseRequest;
use Carbon\Carbon;
use Exception;

class ExpenseBUS
{
	public static function todayExpenses(Request $request) 
	{
		$expenses = new Expense();
		if ($request->has("search")) {
			if ($request->word != "") {
				$expenses = $expenses->where("details", "LIKE", "%{$request->word}%")
						->whereDate('created_at', Carbon::now()->format('Y-m-d'));
			}
			else {
				die();
			}
		}
		else if ($request->has("word")) {
			$expenses = $expenses->where('details', 'LIKE', '%' . $request->word . '%')
					->whereDate('created_at', Carbon::now()->format('Y-m-d'));;
		}
		else {
			$expenses = $expenses->whereDate('created_at', Carbon::now()->format('Y-m-d'));
		}
		return $expenses;
	}

	public static function storeExpense(ExpenseRequest $request) 
	{
		$amount = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', $request->amount)));
		$expense = Expense::create([
            'details' => $request->details,
            'amount' => $amount
        ]);
		return $expense;
	}
	
	public static function updateExpense(ExpenseRequest $request, $id) 
	{
		$expense = Expense::findOrFail($id);
		$amount = floatval(str_replace(',', '.', preg_replace('/[^\d,]/', '', $request->amount)));
		$expense->update([
            'details' => $request->input('details'),
            'amount' => $amount
        ]);
		return $expense;
	}

	public static function monthlyExpenses(Request $request) 
	{
		$expenses = new Expense();
		$month = Carbon::parse($request->month)->format('m');
		$year = Carbon::parse($request->month)->format('Y');
		// return $request->all();
		if ($request->has("search")) {
			if ($request->word != "") {
				$expenses = $expenses->where("details", "LIKE", "%{$request->word}%")
						->whereYear('created_at', $year)
                   		->whereMonth('created_at', $month);
			}
			else {
				die();
			}
		}
		else if ($request->has("word")) {
			$expenses = $expenses->where('details', 'LIKE', '%' . $request->word . '%')
					->whereYear('created_at', $year)
                   	->whereMonth('created_at', $month);
		}
		else if ($request->has("month")) {
			$expenses = $expenses->whereYear('created_at', $year)
                   ->whereMonth('created_at', $month);
		}
		else {
			$expenses = $expenses->whereMonth('created_at', Carbon::now()->format('m'));
		}
		return $expenses;
	}

	public static function yearlyExpenses(Request $request) 
	{
		$expenses = new Expense();
		if ($request->has("search")) {
			if ($request->word != "") {
				$expenses = $expenses->where("details", "LIKE", "%{$request->word}%");
			}
			else {
				die();
			}
		}
		else if ($request->has("word")) {
			$expenses = $expenses->where('details', 'LIKE', '%' . $request->word . '%');
		}
		else {
			$expenses = $expenses->whereYear('created_at', Carbon::now()->format('Y'));

		}
		return $expenses;
	}
}
