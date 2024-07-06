<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB, Hash, Storage;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Designation;
use App\Models\EmployeeSalary;
use App\Models\EmployeeLeave;
use App\Models\LeavePurpose;

class EmployeeLeaveController extends Controller
{
    public function leaveView() {
        $datas = EmployeeLeave::latest()->get();
        
        return view('backend.employee.employee_leave.leave_view', [
            'datas' => $datas
        ]);
    }

    public function leaveAdd() {
        $employees = User::where('usertype', 'employee')->get();
        $purposes = LeavePurpose::all();

        return view('backend.employee.employee_leave.leave_add', [
            'employees' => $employees,
            'purposes' => $purposes
        ]);
    }

    public function leaveStore() {
        //
    }
}
