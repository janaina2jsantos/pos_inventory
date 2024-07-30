<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\Employee;
use App\Http\BUS\AttendanceBUS;
use App\Http\BUS\EmployeeBUS;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AttendanceController extends Controller
{
    public function __construct()
    {
        $this->title = "Attendances";
    }

    public function index()
    {
        return view("attendances.index")
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
        $total = AttendanceBUS::getAttendances($request)->count();
        $attendances = AttendanceBUS::getAttendances($request)
            ->with('employee')
            ->orderBy($order_field, $order_sort)
            ->get()
            ->groupBy(function ($date) {
                return Carbon::parse($date->created_at)->format('Y-m-d');
            });
        $data = [];

        if (!empty($attendances)) {
            foreach ($attendances as $date => $groupedAttendances) {
                $data[] = [
                    'count' => $groupedAttendances->count(),
                    'date' => Carbon::parse($date)->format('d/m/Y')
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

    public function takeAttendance()
    {
        return view("attendances.take")
            ->with('title', $this->title)
            ->with('breadTitle', $this->title);
    }

    public function takeAttendanceAjax(Request $request)
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
            ->where('status', 1)
            ->with('attendances')
            ->orderBy($order_field, $order_sort)
            ->get();
        $data = [];

        if(!empty($employees)) {
            foreach($employees as $employee) {
                $attendance = $employee->attendances()
                    ->whereDate('created_at', Carbon::today())
                    ->first();
                $attendanceStatus = $attendance ? $attendance->attendance : null;

                $data[] = [
                    'id' => $employee->id,
                    'name' => $employee->name,
                    'photo' => $employee->photo,
                    'attendance' => $attendanceStatus
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

    public function store(Request $request) 
    {
        $attendance = AttendanceBUS::storeAttendance($request);
        return response()->json($attendance);
    }

    public function update(Request $request, $id) 
    {
        $attendance = AttendanceBUS::updateAttendance($request, $id);
        return response()->json($attendance);
    }

    public function showAttendances($date) 
    { 
        $breadItems = [
            ['name' => 'Data', 'url' => route('attendances.index')],
            ['name' => 'Attendances Details', 'url' => null],
        ];

        return view("attendances.show")
            ->with('date', $date)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function editAttendances($date) 
    { 
        $breadItems = [
            ['name' => 'Data', 'url' => route('attendances.index')],
            ['name' => 'Edit Attendances', 'url' => null],
        ];

        return view("attendances.edit")
            ->with('date', $date)
            ->with('title', $this->title)
            ->with('breadTitle', $this->title)
            ->with('breadItems', $breadItems);
    }

    public function editAttendancesAjax($date)
    {
        $page = 1;
        $per_page = 10;

        // Define the default order
        $order_field = 'id';
        $order_sort = 'ASC';

        // Get how many items there should be
        $total = AttendanceBUS::editAttendances($date)->count();
        $attendances = AttendanceBUS::editAttendances($date)
            ->with('employee')
            ->orderBy($order_field, $order_sort)
            ->get();
        $data = [];

        if(!empty($attendances)) {
            foreach($attendances as $attendance) {
                $data[] = [
                    'id' => $attendance->id,
                    'name' => $attendance->employee->name,
                    'photo' => $attendance->employee->photo,
                    'attendance' => $attendance->attendance ? $attendance->attendance : null
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

    public function destroy($id) 
    {
        if(AttendanceBUS::destroyAttendance($id)) {  
            return response()->json(["status" => true, "message" => "Attendance successfully deleted."], 200);
        }
        else {
            return response()->json(["status" => false, "message" => "This action couldn't be completed."], 400); 
        }
    }
}
