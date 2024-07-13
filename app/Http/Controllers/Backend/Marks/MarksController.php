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
        $allData = AssignSubject::with("school_subject")->where('class_id', $classId)->get();

        return response()->json($allData);
    }

    public function marksGetStudent(Request $request) {
        $year_id = $request->year_id;
        $class_id = $request->class_id;
        $allData = AssignStudent::with('student')
                    ->where('year_id', $year_id)
                    ->where('class_id', $class_id)
                    ->get();

        return response()->json($allData);
    }

    public function storeMarks(Request $request) {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        foreach ($request->student_id as $key => $value) {
            $id = $request->id_no[$key];
            $mark = $request->marks[$key];

            if (empty($mark)) {
                $notification = [
                    'message' => 'Please Enter the Students` Marks!',
                    'alert-type' => 'error'
                ];
        
                return back()->with($notification);
            }
            else {
                StudentMarks::create([
                    'student_id' => $value,
                    'id_no' => $id,
                    'year_id' => $year_id,
                    'class_id' => $class_id,
                    'assign_subject_id' => $request->assign_subject_id,
                    'exam_type_id' => $request->exam_type_id,
                    'marks' => $mark
                ]);
            }
        }

        $notification = [
            'message' => 'Students` Marks Successfully Inserted',
            'alert-type' => 'success'
        ];

        return back()->with($notification);
    }
}
