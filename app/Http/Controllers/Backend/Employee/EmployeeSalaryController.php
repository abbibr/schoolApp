<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB, Hash, Storage;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Designation;
use App\Models\EmployeeSalary;

class EmployeeSalaryController extends Controller
{
    public function salaryView() {
        $datas = User::where('usertype', 'employee')->get();

        return view('backend.employee.employee_salary.employee_view', [
            'datas' => $datas
        ]);
    }

    public function salaryIncrement($id) {
        $edit = User::find($id);

        return view('backend.employee.employee_salary.employee_increment', [
            'edit' => $edit
        ]);
    }

    public function salaryUpdate($id, Request $request) {
        $employee_user = User::find($id);
        $employee_salary = $employee_user->employee_salary->last();

        $previous_salary = $employee_salary->present_salary;
        $present_salary = floatval($previous_salary) + floatval($request->increment_salary);

        EmployeeSalary::create([
            'employee_id' => $id,
            'previous_salary' => $previous_salary,
            'present_salary' => $present_salary,
            'increment_salary' => $request->increment_salary,
            'effected_salary' => date('Y-m-d', strtotime($request->effected_salary))
        ]);

        $employee_user->update([
            'salary' => $present_salary
        ]);

        $notification = [
            'message' => 'Employee Salary Successfully Updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('employee.salary.view')->with($notification);
    }
}
