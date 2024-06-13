<?php

namespace App\Http\Controllers;

use App\Models\AdvanceSalary;
use App\Models\Employee;
use App\Http\BUS\AdvanceSalaryBUS;
use Illuminate\Http\Request;
use App\Http\Requests\AdvanceSalaryRequest;

class AdvanceSalaryController extends Controller
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
            foreach($advSalaries as $salary) {
                $data[] = [
                    'id' => $salary->id,
                    'employee' => $salary->employee->name,
                    'advance_salary' => '$'.$salary->advance_salary, 
                    'month' => $salary->month->format('M-Y')
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
        $employees = Employee::all();
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
        AdvanceSalaryBUS::storeAdvanceSalary($request);
        return redirect()->route("advance-salaries.index")->with("success", "Advance paid successfully.");
    }

    public function edit($id) 
    { 
        $advSalary = AdvanceSalary::findOrFail($id); 
        $employees = Employee::all();
        $breadItems = [
            ['name' => 'Data', 'url' => route('advance-salaries.index')],
            ['name' => 'Edit Advance Salary Provide', 'url' => null],
        ];

        return view("advance_salaries.edit")
            ->with('advSalary', $advSalary)
            ->with('employees', $employees)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function update(AdvanceSalaryRequest $request, $id) 
    {
        AdvanceSalaryBUS::updateAdvanceSalary($request, $id);
        return redirect()->route("advance-salaries.index")->with("success", "Payment updated successfully.");
    }

    public function destroy($id) 
    {
        try {
            if (AdvanceSalaryBUS::destroyAdvanceSalary($id)) {  
                return response()->json(["status" => true, "message" => "Payment deleted successfully."], 200);
            } 
            else {
                return response()->json(["status" => false, "message" => "This action couldn't be completed."], 400); 
            }
        } 
        catch (Exception $ex) {
            return response()->json(["status" => false, "message" => $ex->getMessage()], 500);
        }
    }
}
