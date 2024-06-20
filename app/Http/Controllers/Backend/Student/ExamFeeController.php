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

   
}
