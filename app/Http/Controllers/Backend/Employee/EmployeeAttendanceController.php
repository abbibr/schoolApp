<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB, Hash, Storage;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;
use App\Models\EmployeeAttendance;

class EmployeeAttendanceController extends Controller
{
    public function attendanceView() {
        $datas = EmployeeAttendance::select('date')->groupBy('date')->orderBy('date', 'desc')->get();

        return view('backend.employee.employee_attendance.view_attendance', [
            'datas' => $datas
        ]);
    }

    public function attendanceAdd() {
        $employees = User::where('usertype', 'employee')->get();

        return view('backend.employee.employee_attendance.add_attendance', [
            'employees' => $employees
        ]);
    }

    public function attendanceStore(Request $request) {
        $request->validate([
            'date' => 'date|required'
        ], 
        [
            'date.required' => 'Please enter the Date!'
        ]);

        $employees_id = $request->employee_id;

        foreach ($employees_id as $key => $employee_id) {
            $attend_status = 'attend_status'.$key;

            EmployeeAttendance::create([
                'date' => date('Y-m-d', strtotime($request->date)),
                'user_id' => $employee_id,
                'attend_status' => $request->$attend_status
            ]);
        }

        $notification = [
            'message' => 'Employees` Attendance Successfully Inserted',
            'alert-type' => 'success'
        ];

        return redirect()->route('employee.attendance.view')->with($notification);
    }

    public function attendanceDetails($date) {
        $dateAttendances = EmployeeAttendance::where('date', $date)->get();

        return view('backend.employee.employee_attendance.details_attendance', [
            'dateAttendances' => $dateAttendances
        ]);
    }

    public function attendanceEdit($date) {
        $edit_employees = EmployeeAttendance::where('date', $date)->get();

        return view('backend.employee.employee_attendance.edit_attendance', [
            'edit_employees' => $edit_employees
        ]);
    }
}
