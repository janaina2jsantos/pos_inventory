<?php

namespace App\Http\BUS;

use App\Models\Attendance;
use Illuminate\Http\Request;
// use App\Http\Requests\ProductRequest;
use Carbon\Carbon;
use Exception;

class AttendanceBUS
{
	public static function storeAttendance(Request $request) 
	{
		$hasAttendance = Attendance::where('employee_id', $request->employee_id)
			->whereDate('created_at', Carbon::today())->first();

		if (!$hasAttendance) {
			$attendance = Attendance::create([
	            'employee_id' => $request->employee_id,
	            'attendance' => $request->attendance
	        ]);
			return $attendance;
		}
		else {
			$hasAttendance->update([
	            'attendance' => $request->input('attendance')
	        ]);
			return $hasAttendance;
		}
	}
}
