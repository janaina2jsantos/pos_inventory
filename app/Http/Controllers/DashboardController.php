<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Http\BUS\EmployeeBUS;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->title = "Dashboard";
    }

    public function index(Request $request)
    {
        $month = date('Y-m', strtotime('-1 month'));
        $employees = EmployeeBUS::getEmployees($request)
            ->where('status', 1)
            ->count();
        $salariesToPay = DB::table('employees')
            ->leftJoin('salaries', 'employees.id', '=', 'salaries.employee_id')
            ->whereNotIn('salaries.employee_id', ['employees.id'])
            ->where("salaries.month", "NOT LIKE", "%{$month}%")
            ->count();
        // dd($salariesToPay);
        $pctm = (($employees - $salariesToPay) / $employees) * 100;
        
        return view("dashboard")
            ->with('salariesToPay', $salariesToPay)
            ->with('pctm', $pctm)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title);
    }
}

