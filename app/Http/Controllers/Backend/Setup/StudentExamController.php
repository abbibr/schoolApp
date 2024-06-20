<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentExam;

class StudentExamController extends Controller
{
    public function studentExamView(){
        $datas = StudentExam::all();

        return view('backend.setup.student_exam.view_exam', [
            'datas' => $datas
        ]);
    }

    public function StudentExamAdd(){
        return view('backend.setup.student_exam.add_exam');
    }

    public function StudentExamStore(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:student_exams'
        ]);

        StudentExam::create([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Student Exam Successfully Inserted',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.exam.view')->with($notification);
    }

    public function StudentExamEdit($id){
        $edit_class = StudentExam::findOrFail($id);

        return view('backend.setup.student_exam.edit_exam', [
            'edit_class' => $edit_class
        ]);
    }

    public function StudentExamUpdate(Request $request, $id){
        $this->validate($request, [
            'name' => 'required'
        ]);

        $class = StudentExam::find($id);

        $class->update([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Student Exam Successfully Updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.exam.view')->with($notification); 
    }

    public function StudentExamDelete($id){
        $class = StudentExam::findOrFail($id);
        $class->delete();

        $notification = [
            'message' => 'Student Exam Successfully Deleted',
            'alert-type' => 'info'
        ];

        return redirect()->route('student.exam.view')->with($notification);   
    }
}
