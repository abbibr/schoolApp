<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentSubject;

class StudentSubjectController extends Controller
{
    public function StudentSubjectView(){
        $datas = StudentSubject::all();

        return view('backend.setup.student_subject.view_subject', [
            'datas' => $datas
        ]);
    }

    public function StudentSubjectAdd(){
        return view('backend.setup.student_subject.add_subject');
    }

    public function StudentSubjectStore(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:student_subjects'
        ]);

        StudentSubject::create([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Student Subject Successfully Inserted',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.subject.view')->with($notification);
    }

    public function StudentSubjectEdit($id){
        $edit_class = StudentSubject::findOrFail($id);

        return view('backend.setup.student_subject.edit_subject', [
            'edit_class' => $edit_class
        ]);
    }

    public function StudentSubjectUpdate(Request $request, $id){
        $this->validate($request, [
            'name' => 'required'
        ]);

        $class = StudentSubject::find($id);

        $class->update([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Student Subject Successfully Updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.subject.view')->with($notification); 
    }

    public function StudentSubjectDelete($id){
        $class = StudentSubject::findOrFail($id);
        $class->delete();

        $notification = [
            'message' => 'Student Subject Successfully Deleted',
            'alert-type' => 'info'
        ];

        return redirect()->route('student.subject.view')->with($notification);   
    }
}
