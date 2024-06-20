<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use App\Models\AssignStudent;
use App\Models\FeeCategoryAmount;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\StudentYear;

class ExamFeeController extends Controller
{
    public function feeView()
    {
        $years = StudentYear::orderBy('name', 'asc')->get();
        $classes = StudentClass::all();

        return view('backend.student.exam_fee.exam_fee_view', [
            'years' => $years,
            'classes' => $classes
        ]);
    }

    public function feeGenerate(Request $request)
    {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        $assign_students = AssignStudent::where('class_id', $class_id)
            ->where('year_id', $year_id)
            ->get();

        $html['thsource'] = '<th>#</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Role No</th>';
        $html['thsource'] .= '<th>Monthly Fee (sum)</th>';
        $html['thsource'] .= '<th>Discount %</th>';
        $html['thsource'] .= '<th>Student Fee (sum)</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($assign_students as $key => $value) {
            $fee_category_amount = FeeCategoryAmount::where('fee_category_id', 4)
                ->where('student_class_id', $class_id)
                ->get();

                $html[$key]['tdsource'] = '<td>' . ($key + 1) . '</td>';
                $html[$key]['tdsource'] .= '<td>' . $value->student->id_no . '</td>';
                $html[$key]['tdsource'] .= '<td>' . $value->student->name . '</td>';
                $html[$key]['tdsource'] .= '<td>' . $value->roll . '</td>';
                $html[$key]['tdsource'] .= '<td>' . $fee_category_amount->amount . '</td>';
                $html[$key]['tdsource'] .= '<td>' . $value->discount[0]->discount . '%' . '</td>';
    
                $originalfee = $fee_category_amount->amount;
                $discount = $value->discount[0]->discount;
                $discounttablefee = $discount / 100 * $originalfee;
                $finalfee = (float) $originalfee - (float) $discounttablefee;
    
                $html[$key]['tdsource'] .= '<td>' . $finalfee . '</td>';
                $html[$key]['tdsource'] .= '<td>';
                $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-green" title="PaySlip" target="_blanks" href="'.route("student.registration.fee.payslip").'?class_id='.$value->class_id.'&student_id='.$value->student_id.'">Exam Fee</a>';
                $html[$key]['tdsource'] .= '</td>';
        }

        return response()->json(@$html);
    }
}
