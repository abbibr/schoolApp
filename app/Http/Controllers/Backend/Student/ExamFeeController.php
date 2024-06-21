<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\AssignStudent;
use App\Models\StudentExam;
use App\Models\FeeCategoryAmount;
use Barryvdh\DomPDF\Facade\PDF;

class ExamFeeController extends Controller
{
    public function feeView() {
        $years = StudentYear::orderBy('name', 'asc')->get();
        $classes = StudentClass::all();
        $exams = StudentExam::all();

        return view('backend.student.exam_fee.exam_fee', [
            'years' => $years,
            'classes' => $classes,
            'exams' => $exams
        ]);
    }

    public function feeGenerate(Request $request) {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $exam = $request->exam;

        $assign_students = AssignStudent::where('class_id', $class_id)
            ->where('year_id', $year_id)
            ->get();

        $html['thsource'] = '<th>#</th>';
        $html['thsource'] .= '<th>ID No</th>';
        $html['thsource'] .= '<th>Student Name</th>';
        $html['thsource'] .= '<th>Role No</th>';
        $html['thsource'] .= '<th>Exam Fee (sum)</th>';
        $html['thsource'] .= '<th>Discount %</th>';
        $html['thsource'] .= '<th>Student Fee (sum)</th>';
        $html['thsource'] .= '<th>Action</th>';

        foreach ($assign_students as $key => $value) {
            $fee_category_amount = FeeCategoryAmount::where('fee_category_id', 4)
                ->where('student_class_id', $class_id)
                ->first();

            if (empty($fee_category_amount->student_class_id)) {
                $html['thsource'] = '<h3 style="color: #CC4A93;">We don`t have any student in this category!</h3>';
                return response()->json(@$html);
            }

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
            $html[$key]['tdsource'] .= '<a class="btn btn-sm btn-success" title="PaySlip" target="_blanks" href="' . route("exam.pdf.generate") . '?class_id=' . $value->class_id . '&exam=' . $request->exam . '&student_id=' . $value->student_id . '">Exam Fee</a>';
            $html[$key]['tdsource'] .= '</td>';
        }

        return response()->json(@$html);
    }

    public function feePdf(Request $request) {
        $class_id = $request->class_id;
        $student_id = $request->student_id;

        $assign_student = AssignStudent::where('class_id', $class_id)
                            ->where('student_id', $student_id)
                            ->first();

        $fee_category_amount = FeeCategoryAmount::where('fee_category_id', 4)
                            ->where('student_class_id', $class_id)
                            ->first();

        $exam = StudentExam::where('id', $request->exam)->first()->name;
        
        $original_amount = $fee_category_amount->amount;
        $discount = $assign_student->discount[0]->discount;
        $discount_sum = $original_amount / 100 * $discount;
        $final_fee = floatval($original_amount) - floatval($discount_sum);

        $pdf = Pdf::loadView('backend.student.exam_fee.exam_pdf', [
            'assign_student' => $assign_student,
            'fee_category_amount' => $fee_category_amount,
            'final_fee' => $final_fee,
            'exam' => $exam
        ]);

        return $pdf->download("$exam/".$assign_student->student->name.".pdf");
    }
}
