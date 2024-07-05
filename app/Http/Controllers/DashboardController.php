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
        $employees = EmployeeBUS::getEmployees($request)
            ->where('status', 1)
            ->count();

        $salariesToPay = DB::table('employees')
            ->where('employees.status', 1)
            ->whereNotIn('employees.id', function($q) {
                $month = date('Y-m', strtotime('-1 month'));
                $q->select('salaries.employee_id')
                    ->from('salaries')
                    ->where("salaries.month", "LIKE", "%{$month}%");
            })->count();

        $pctm = (($employees - $salariesToPay) / $employees) * 100;
        
        return view("dashboard")
            ->with('salariesToPay', $salariesToPay)
            ->with('pctm', $pctm)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title);
    }
}

