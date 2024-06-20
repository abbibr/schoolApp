<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\FeeCategoryAmount;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class RegistrationFeeController extends Controller
{
    public function feeView()
    {
        $years = StudentYear::orderBy('name', 'asc')->get();
        $classes = StudentClass::all();

        return view('backend.student.registration_fee.fee_view', [
            'years' => $years,
            'classes' => $classes,
        ]);
    }

    public function feeGenerate(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
    
        $allStudent = AssignStudent::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->get();

        $html['thsource'] = '<th>#</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Role No</th>';
        $html['thsource'] .= '<th>Registration Fee (sum)</th>';
        $html['thsource'] .= '<th>Discount %</th>';
        $html['thsource'] .= '<th>Student Fee (sum)</th>';
        $html['thsource'] .= '<th>Action</th>';


        foreach ($allStudent as $key => $v) {
            $registrationfee = FeeCategoryAmount::where('fee_category_id', '1')->where('student_class_id', $v->class_id)->first();
            $color = 'success';
            $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v->student->id_no . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v->student->name . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v->roll . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $registrationfee->amount . '</td>';
            $html[$key]['tdsource'] .= '<td>' . $v->discount[0]->discount . '%' . '</td>';

            $originalfee = $registrationfee->amount;
            $discount = $v->discount[0]->discount;
            $discounttablefee = $discount / 100 * $originalfee;
            $finalfee = (float) $originalfee - (float) $discounttablefee;

            $html[$key]['tdsource'] .= '<td>' . $finalfee . '</td>';
            $html[$key]['tdsource'] .= '<td>';
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-'.$color.'" title="PaySlip" target="_blanks" href="'.route("student.registration.fee.payslip").'?class_id='.$v->class_id.'&student_id='.$v->student_id.'">Student Fee</a>';
            $html[$key]['tdsource'] .= '</td>';
        }
        return response()->json(@$html);
    }

    public function pdfGenerate(Request $request) {
        $class_id = $request->class_id;
        $student_id = $request->student_id;

        $assign_student = AssignStudent::where('student_id', $student_id)
            ->where('class_id', $class_id)
            ->first();

        $fee_amount = FeeCategoryAmount::where('fee_category_id', 1)
            ->where('student_class_id', $class_id)
            ->first();

        $original_fee = $fee_amount->amount;
        $discount = $assign_student->discount[0]->discount;
        $discount_sum = $original_fee / 100 * $discount;
        $final_fee = floatval($original_fee) - floatval($discount_sum);

        $pdf = PDF::loadView('backend.student.registration_fee.fee_pdf', [
            'assign_student' => $assign_student,
            'fee_amount' => $fee_amount,
            'final_fee' => $final_fee
        ]);

        return $pdf->download("feeDetails/".$assign_student->student->name.".pdf");
    }
}
