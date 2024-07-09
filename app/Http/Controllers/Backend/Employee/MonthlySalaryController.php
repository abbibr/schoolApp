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
        $date = $request->date;
        $allStudent = EmployeeAttendance::select('user_id')->groupBy('user_id')->with('employee')->where('date', $date)->get();

        $html['thsource'] = '<th>#</th>';
        $html['thsource'] .= '<th>Employee Name</th>';
        $html['thsource'] .= '<th>Basic Salary</th>';
        $html['thsource'] .= '<th>Salary This Month</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($allStudent as $key => $v) {
            $totalAttend = EmployeeAttendance::with('employee')->where('date', $date)->where('user_id', $v->user_id)->get();

            // $color = 'success';
            // $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            // $html[$key]['tdsource'] .= '<td>' . $v->student->id_no . '</td>';
            // $html[$key]['tdsource'] .= '<td>' . $v->student->name . '</td>';
            // $html[$key]['tdsource'] .= '<td>' . $v->roll . '</td>';
            // $html[$key]['tdsource'] .= '<td>' . $registrationfee->amount . '</td>';
            // $html[$key]['tdsource'] .= '<td>' . $v->discount[0]->discount . '%' . '</td>';

            // $originalfee = $registrationfee->amount;
            // $discount = $v->discount[0]->discount;
            // $discounttablefee = $discount / 100 * $originalfee;
            // $finalfee = (float) $originalfee - (float) $discounttablefee;

            // $html[$key]['tdsource'] .= '<td>' . $finalfee . '</td>';
            // $html[$key]['tdsource'] .= '<td>';
            // $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("student.registration.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'">Student Fee</a>';
            // $html[$key]['tdsource'] .= '</td>';
        }
        // return response()->json(@$html);
    }
}
