<?php

namespace App\Http\Controllers;

use App\Models\Salary;
use App\Models\AdvanceSalary;
use App\Models\Employee;
use App\Http\BUS\AdvanceSalaryBUS;
use App\Http\BUS\SalaryBUS;
use App\Http\BUS\EmployeeBUS;
use Illuminate\Http\Request;
use App\Http\Requests\AdvanceSalaryRequest;
use DB;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->title = "Advance Salaries";
    }

    public function index()
    {
        return view("advance_salaries.index")
            ->with('title', $this->title)
            ->with('breadTitle', $this->title);
    }

    public function indexAjax(Request $request)
    {
        $prevMonth = date("Y-m", strtotime('-1 month'));
        $page = 1;
        $per_page = 10;

        // Define the default order
        $order_field = 'id';
        $order_sort = 'DESC';

        // Get the request parameters
        $params = $request->all();

        // Set the current page
        if(isset($params['pagination']['page']))
        {
            $page = $params['pagination']['page'];
        }

        // Set the number of items
        if(isset($params['pagination']['perpage']))
        {
            $per_page = $params['pagination']['perpage'];
        }

        // Set the sort order and field
        if(isset($params['sort']['field']))
        {
            $order_field = $params['sort']['field'];
            $order_sort = $params['sort']['sort'];
        }

        // Get how many items there should be
        $total = AdvanceSalaryBUS::getAdvanceSalaries($request)->count();
        $advSalaries = AdvanceSalaryBUS::getAdvanceSalaries($request)
            ->orderBy($order_field, $order_sort)
            ->get();
        $data = [];

        if(!empty($advSalaries)) {
            foreach($advSalaries as $adv) {
                $data[] = [
                    'id' => $adv->id,
                    'employee_name' => $adv->employee->name,
                    'employee_salary' => '$'.$adv->employee->salary,
                    'advance_salary' => '$'.$adv->advance_salary, 
                    'photo' => $adv->employee->photo,
                    'isPaid' => $adv->employee->salaries()->where("employee_id", $adv->employee->id)->where("month", "LIKE", "%{$prevMonth}%")->where("status", 1)->pluck('month'),
                    'month' => $adv->month
                ];
            }
        }

        $response = [
            'meta' => [
                "page" => $page,
                "pages" => ceil($total / $per_page),
                "perpage" => $per_page,
                "total" => $total,
                "sort" => $order_sort,
                "field" => $order_field
            ],
            'data' => $data
        ];

        return response()->json($response);
    }

    public function create() 
    {
        $employees = Employee::where('status', 1)->get();
        $breadItems = [
            ['name' => 'Data', 'url' => route('advance-salaries.index')],
            ['name' => 'Advance Salary Provide', 'url' => null],
        ];

        return view("advance_salaries.create")
            ->with('employees', $employees)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function store(AdvanceSalaryRequest $request) 
    {
        // dd($request->all());
        $rowCount = AdvanceSalaryBUS::storeAdvanceSalary($request);

        if ($rowCount) {
            return redirect()->route("advance-salaries.index")->with("success", "Advance successfully paid.");
        }
        else {
            return redirect()->back()->withErrors(["error" => "Advance already paid in this month for this employee."]);
        }
    }

    public function edit($id) 
    { 
        $prevMonth = date("Y-m", strtotime('-1 month'));
        $advSalary = AdvanceSalary::findOrFail($id); 
        $employees = Employee::where('status', 1)->get();
        $breadItems = [
            ['name' => 'Data', 'url' => route('advance-salaries.index')],
            ['name' => 'Edit Advance Salary Provide', 'url' => null],
        ];

        $isPaid = DB::table('salaries')
            ->select('salaries.month')
            ->join('employees', 'salaries.employee_id', '=', 'employees.id')
            ->where('salaries.employee_id', $advSalary->employee->id)
            ->where("salaries.month", "LIKE", "%{$prevMonth}%")
            ->where('salaries.status', 1)
            ->first();

        return view("advance_salaries.edit")
            ->with('advSalary', $advSalary)
            ->with('employees', $employees)
            ->with('isPaid', date('Y-m', strtotime($isPaid->month)))
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function update(AdvanceSalaryRequest $request, $id) 
    {
        AdvanceSalaryBUS::updateAdvanceSalary($request, $id);
        return redirect()->route("advance-salaries.index")->with("success", "Advance successfully updated.");
    }

    public function destroy($id) 
    {
        try {
            if (AdvanceSalaryBUS::destroyAdvanceSalary($id)) {  
                return response()->json(["status" => true, "message" => "Advance successfully deleted."], 200);
            } 
            else {
                return response()->json(["status" => false, "message" => "This action couldn't be completed."], 400); 
            }
        } 
        catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }

    public function recurringAdvanceAjax($id) 
    {
        $rowCount = AdvanceSalaryBUS::recurringAdvanceSalary($id);
        
        if ($rowCount) {
            return response()->json(["status" => true, "message" => "Advance successfully paid."], 200);

        }
        else {
            return response()->json(["status" => false, "message" => "Advance already paid in this month for this employee."], 400); 
        }
    }

    public function paySalary()
    {
        return view("advance_salaries.pay-salary")
            ->with('title', $this->title)
            ->with('breadTitle', $this->title);
    }

    public function paySalaryAjax(Request $request)
    {
        $prevMonth = date("Y-m", strtotime('-1 month'));
        $page = 1;
        $per_page = 10;

        // Define the default order
        $order_field = 'id';
        $order_sort = 'DESC';

        // Get the request parameters
        $params = $request->all();

        // Set the current page
        if(isset($params['pagination']['page']))
        {
            $page = $params['pagination']['page'];
        }

        // Set the number of items
        if(isset($params['pagination']['perpage']))
        {
            $per_page = $params['pagination']['perpage'];
        }

        // Set the sort order and field
        if(isset($params['sort']['field']))
        {
            $order_field = $params['sort']['field'];
            $order_sort = $params['sort']['sort'];
        }

        // Get how many items there should be
        $total = EmployeeBUS::getEmployees($request)
            ->where('status', 1)
            ->count();
        $employees = EmployeeBUS::getEmployees($request)
            ->where('status', 1)
            ->orderBy($order_field, $order_sort)
            ->get();
        $data = [];

        if ($request->has("word")) {
            $employees = Employee::whereHas('salaries', function($q) use($request) {
                $q->where("name", "LIKE", "%{$request->word}%");
            })->get();
        }
        if ($request->has("month")) {
            $employees = Employee::whereHas('salaries', function($q) use($request) {
                $q->where("month", "LIKE", "%{$request->month}%");
            })->get();
        }

        if(!empty($employees)) {
            foreach($employees as $employee) {
                $data[] = [
                    'id' => $employee->id,
                    'employee' => $employee->name,
                    'salary' => '$'.$employee->salary,
                    'month' => date('F', strtotime('-1 month')),
                    'advance' => $employee->advanceSalaries()->where("month", "LIKE", "%{$prevMonth}%")->pluck('advance_salary'),
                    'isPaid' => $employee->salaries()->where("employee_id", $employee->id)->where("month", "LIKE", "%{$prevMonth}%")->where("status", 1)->get(),
                    'photo' => $employee->photo
                ];
            }
        }

        $response = [
            'meta' => [
                "page" => $page,
                "pages" => ceil($total / $per_page),
                "perpage" => $per_page,
                "total" => $total,
                "sort" => $order_sort,
                "field" => $order_field
            ],
            'data' => $data
        ];

        return response()->json($response);
    }

    public function paySalaryToEmployeeAjax($id)
    {
        try {
            $employee = Employee::with('advanceSalaries')->find($id);

            if (count($employee->advanceSalaries)) {
                $amount = $employee->salary - $employee->advanceSalaries[0]->advance_salary;
            }
            else {
                $amount = $employee->salary;
            }

            $salary = Salary::create([
                'employee_id' => $employee->id,
                'month' => date('F', strtotime('-1 month')),
                'paid_amount' => $amount,
                'status' => 1
            ]);
            return response()->json(["status" => true, "message" => "Salary paid successfully."], 200);
        } 
        catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }
}
