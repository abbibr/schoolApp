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
        $datas = EmployeeAttendance::latest()->get();

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
        return $request->group;
    }
}
