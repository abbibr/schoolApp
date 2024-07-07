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
        $leaves = EmployeeLeave::all();

        return view('backend.employee.employee_leave.leave_add', [
            'employees' => $employees,
            'purposes' => $purposes,
            'leaves' => $leaves
        ]);
    }

    public function leaveStore(Request $request) {
        $employee = User::where('id', $request->employee_id)->first();
        $employee_leave = EmployeeLeave::where('employee_id', $request->employee_id)->first();

        if (empty($employee_leave)) {
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
        else {
            $notification = [
                'message' => 'This employee has already left!',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
    }

    public function leaveEdit($id) {
        $employee_leave = EmployeeLeave::findOrFail($id);
        $employees = User::where('usertype', 'employee')->get();
        $purposes = LeavePurpose::all();

        return view('backend.employee.employee_leave.leave_edit', [
            'employee_leave' => $employee_leave,
            'employees' => $employees,
            'purposes' => $purposes
        ]);
    }

    public function leaveUpdate($id, Request $request) {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
        ],
        [
            'start_date.required' => 'Please enter the start date of leaving employee!',
            'end_date.required' => 'Please enter the end date of leaving employee!',
        ]);

        $employee_leave = EmployeeLeave::findOrFail($id);
        $leave = EmployeeLeave::where('employee_id', $request->employee_id)->whereNot('id', $id)->first();

        if (!empty($leave)) {
            $notification = [
                'message' => 'This employee has already left!',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
        else {
            $employee_leave->update([
                'employee_id' => $request->employee_id,
                'purpose_id' => $request->purpose_id,
                'start_date' => date('Y-m-d', strtotime($request->start_date)),
                'end_date' => date('Y-m-d', strtotime($request->end_date)),
            ]);

            $notification = [
                'message' => 'Successfully Updated',
                'alert-type' => 'success'
            ];

            return redirect()->route('employee.leave.view')->with($notification);
        }
    }
}
