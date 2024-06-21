<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\AssignStudent;
use App\Models\StudentExam;
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

        return $exam;
    }
}
