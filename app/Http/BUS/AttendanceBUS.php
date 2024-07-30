<?php

namespace App\Http\BUS;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;

class AttendanceBUS
{
	public static function getAttendances(Request $request) 
	{
		$attendances = new Attendance();
		$month = Carbon::parse($request->month)->format('m');
		$year = Carbon::parse($request->month)->format('Y');

		if ($request->has("search")) {
			if ($request->has("month")) {
				$attendances = $attendances->whereYear('created_at', $year)
                   ->whereMonth('created_at', $month);
			}
			else {
				die();
			}
		}
		
		if ($request->has("month")) {			
			$attendances = $attendances->whereYear('created_at', $year)
                   ->whereMonth('created_at', $month);
		}
		
		return $attendances;
	}

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
			return false;
		}
	}

	// edit one attendance
	public static function updateAttendance(Request $request, $id) 
	{
		$attendance = Attendance::where('id', $id)->first();
		$attendance->update([
            'attendance' => $request->input('attendance')
        ]);
		return $attendance;
	}

	// retrieve attendances by date
	public static function editAttendances($date) 
	{
		$attendances = Attendance::whereDate("created_at", "LIKE", "%{$date}%"); 
		return $attendances;
	}

	public static function destroyAttendance($id) 
	{
        try {
        	return Attendance::findOrFail($id)->delete();
		}
		catch(Exception $ex) {
			return false;
		}
	}
}
