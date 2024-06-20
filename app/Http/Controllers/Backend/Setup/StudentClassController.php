<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentClass;

class StudentClassController extends Controller
{
    public function studentView(){
        $datas = StudentClass::all();

        return view('backend.setup.student_class.view_class', [
            'datas' => $datas
        ]);
    }

    public function studentClassAdd(){
        return view('backend.setup.student_class.add_class');
    }

    public function studentClassStore(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:student_classes'
        ]);

        StudentClass::create([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Student Class Successfully Inserted',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.class.view')->with($notification);
    }

    public function studentClassEdit($id){
        $edit_class = StudentClass::findOrFail($id);

        return view('backend.setup.student_class.edit_class', [
            'edit_class' => $edit_class
        ]);
    }

    public function studentClassUpdate(Request $request, $id){
        $this->validate($request, [
            'name' => 'required'
        ]);

        $class = StudentClass::find($id);

        $class->update([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Student Class Successfully Updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.class.view')->with($notification); 
    }

    public function studentClassDelete($id){
        $class = StudentClass::findOrFail($id);
        $class->delete();

        $notification = [
            'message' => 'Student Class Successfully Deleted',
            'alert-type' => 'info'
        ];

        return redirect()->route('user.view')->with($notification);   
    }
}
