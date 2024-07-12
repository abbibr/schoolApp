<?php

namespace App\Http\Controllers\Backend\Marks;

use App\Http\Controllers\Controller;
use App\Models\AssignSubject;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;
use App\Models\StudentMarks;
use App\Models\StudentExam;

use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use DB, Hash, Storage;
use Barryvdh\DomPDF\Facade\PDF;

class MarksController extends Controller
{
    public function marksAdd() {
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $exams = StudentExam::all();

        return view('backend.marks.marks_add', [
            'years' => $years,
            'classes' => $classes,
            'exams' => $exams
        ]);
    }

    public function marksGetSubject(Request $request) {
        $classId = $request->class_id;
        $allData = AssignSubject::with(["school_subject"])->where('class_id', $classId)->get();

        return response()->json($allData);
    }
}
