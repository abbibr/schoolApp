<?php

namespace App\Http\Controllers\backend\employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB, Hash, Storage;
use Barryvdh\DomPDF\Facade\PDF;
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

    public function leaveStore(Request $request) {
        $employee = User::where('id', $request->employee_id)->first();

        if($request->purpose_id == 0) {
            $purpose = LeavePurpose::create([
                'name' => $request->name
            ]);

            EmployeeLeave::create([
                'employee_id' => $employee->id,
                'purpose_id' => $purpose->id,
                'start_date' => date('Y-m-d', strtotime($request->start_date)),
                'end_date' => date('Y-m-d', strtotime($request->end_date))
            ]);

            $notification = [
                'message' => 'Left Employee Successfully Inserted',
                'alert-type' => 'success'
            ];

            return redirect()->route('employee.leave.view')->with($notification);
        }
        else 
        {
            EmployeeLeave::create([
                'employee_id' => $employee->id,
                'purpose_id' => $request->purpose_id,
                'start_date' => date('Y-m-d', strtotime($request->start_date)),
                'end_date' => date('Y-m-d', strtotime($request->end_date))
            ]);

            $notification = [
                'message' => 'Left Employee Successfully Inserted',
                'alert-type' => 'success'
            ];

            return redirect()->route('employee.leave.view')->with($notification);
        }
    }
}
