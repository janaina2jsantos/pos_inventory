<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Http\BUS\EmployeeBUS;
use Illuminate\Http\Request;
use App\Http\Requests\EmployeeRequest;

class EmployeeController extends Controller
{
    public function __construct()
    {
        $this->title = "Employees";
    }

    public function index()
    {
        return view("employees.index")
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
        $total = EmployeeBUS::getEmployees($request)->count();
        $employees = EmployeeBUS::getEmployees($request)
            ->orderBy($order_field, $order_sort)
            ->get();
        $data = [];

        if(!empty($employees)) {
            foreach($employees as $employee) {
                $data[] = [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'email' => $employee->email,
                    'city' => $employee->city,
                    'state' => $employee->state,
                    'role' => $employee->role,
                    'experience'  => $employee->experience,
                    'photo' => $employee->photo,
                    'status'  => $employee->status
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
        $breadItems = [
            ['name' => 'Data', 'url' => route('employees.index')],
            ['name' => 'Add Employee', 'url' => null],
        ];

        return view("employees.create")
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function store(EmployeeRequest $request) 
    {
        EmployeeBUS::storeEmployee($request);
        return redirect()->route("employees.index")->with("success", "Employee successfully created.");
    }

    public function show($id) 
    { 
        $employee = Employee::findOrFail($id); 
        $breadItems = [
            ['name' => 'Data', 'url' => route('employees.index')],
            ['name' => 'Basic Information', 'url' => null],
        ];

        return view("employees.show")
            ->with('employee', $employee)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function edit($id) 
    { 
        $employee = Employee::findOrFail($id); 
        $breadItems = [
            ['name' => 'Data', 'url' => route('employees.index')],
            ['name' => 'Edit Employee', 'url' => null],
        ];

        return view("employees.edit")
            ->with('employee', $employee)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function update(EmployeeRequest $request, $id) 
    {
        EmployeeBUS::updateEmployee($request, $id);
        return redirect()->route("employees.index")->with("success", "Employee successfully updated.");
    }

    public function destroy($id) 
    {
        if(EmployeeBUS::destroyEmployee($id)) {  
            return response()->json(["status" => true, "message" => "Employee successfully deleted."], 200);
        }
        else {
            return response()->json(["status" => false, "message" => "This action couldn't be completed."], 400); 
        }
    }
}
