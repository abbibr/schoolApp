<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;

use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use DB, Hash, Storage;
use Barryvdh\DomPDF\Facade\PDF;

class StudentRoleController extends Controller
{
    public function StudentRoleView() {
        $data['years'] = StudentYear::orderBy('name', 'asc')->get();
        $data['classes'] = StudentClass::all();

        return view('backend.student.role_generate.role_view', $data);
    }

    public function StudentRole(Request $request) {
        // Get student, student relation from model
        $allData = AssignStudent::with('student')
                ->where('year_id', $request->year_id)
                ->where('class_id', $request->class_id)
                ->get();

        return response()->json($allData);
    }

    public function StudentRoleInsert(Request $request) {
        $year_id = $request->year_id;
        $class_id = $request->class_id;

        if(!empty($request->student_id)) {
            foreach ($request->student_id as $key => $value) {
                $roll = $request->roll[$key];
              
                AssignStudent::where('year_id', $year_id)
                    ->where('class_id', $class_id)
                    ->where('student_id', $value)
                    ->update([
                        'roll' => $roll
                    ]);
            }

            $notification = [
                'message' => "Student Role Successfully Updated",
                'alert-type' => 'success'
            ];
    
            return redirect()->back()->with($notification);
        }
        else {
            $notification = [
                'message' => 'We don`t have any students in this category!',
                'alert-type' => 'error'
            ];
    
            return redirect()->back()->with($notification);
        }
    }
}
