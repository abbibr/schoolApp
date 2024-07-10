<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use App\Models\EmployeeAttendance;
use Illuminate\Http\Request;
use App\Models\User;
use DB, Hash, Storage;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Designation;
use App\Models\EmployeeSalary;

class MonthlySalaryController extends Controller
{
    public function monthlyView() {
        return view('backend.employee.monthly_salary.view_salary');
    }

    public function monthlyAttendance(Request $request) {
        $date = date('Y-m', strtotime($request->date));
        if($date != '') {
            $where[] = ['date', 'like', $date.'%'];
        }

        $allStudent = EmployeeAttendance::select('user_id')->groupBy('user_id')->with('employee')->where($where)->get();

        $html['thsource'] = '<th>#</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($allStudent as $key => $v) {
            $totalAttend = EmployeeAttendance::with('employee')->where($where)->where('user_id', $v->user_id)->get();
            $absentCount = count($totalAttend->where('attend_status', 'absent'));

            $color = 'success'; 
            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v->employee->name . '</td>';
            $html[$key]['tdsource'] .= '<td>' . number_format($v->employee->salary) . '</td>';

            $salary = (float) $v->employee->salary;
            $salaryPerDay = (float) $salary / 30;
            $totalSalaryMinus = (float) $absentCount * $salaryPerDay;
            $totalSalary = (float) $salary - (float) $totalSalaryMinus;

            $html[$key]['tdsource'] .= '<td>' . number_format($totalSalary) . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("employee.monthly.salary.payslip", $v->user_id).'">Employee Monthly Fee</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    public function monthlyPaySlip($user_id) {
        $employeeUserId = EmployeeAttendance::where('user_id', $user_id)->first();
        $date = date('Y-m', strtotime($employeeUserId->date));

        if ($date != '') {
            $where[] = ['date', 'like', $date.'%'];
        }

        $details = EmployeeAttendance::with('employee')
                        ->where('user_id', $employeeUserId->user_id)
                        ->where($where)
                        ->get();

        $absentCount = count($details->where('attend_status', 'absent'));
        $salary = (float) $details[0]->employee->salary;
        $salaryPerDay = (float) $salary / 30;
        $totalSalaryMinus = (float) $absentCount * $salaryPerDay;
        $totalSalary = (float) $salary - (float) $totalSalaryMinus;

        $pdf = PDF::loadView('backend.employee.monthly_salary.pdf_salary', [
            'details' => $details,
            'totalSalary' => $totalSalary,
            'absentCount' => $absentCount,
            'salary' => $salary,
            'date' => $date
        ]);

        return $pdf->download($employeeUserId->employee->name."_monthly_salary.pdf");
    }
}
