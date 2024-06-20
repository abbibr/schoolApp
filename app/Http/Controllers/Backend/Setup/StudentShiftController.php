<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentShift;

class StudentShiftController extends Controller
{
    public function studentShiftView(){
        $datas = StudentShift::orderBy('name', 'desc')->get();

        return view('backend.setup.shift.view_shift', [
            'datas' => $datas
        ]);
    }

    public function studentShiftAdd(){
        return view('backend.setup.shift.add_shift');
    }

    public function studentShiftStore(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:student_shifts'
        ]);

        StudentShift::create([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Student Shift Successfully Inserted',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.shift.view')->with($notification);
    }

    public function studentShiftEdit($id){
        $edit_class = StudentShift::findOrFail($id);

        return view('backend.setup.shift.edit_shift', [
            'edit_class' => $edit_class
        ]);
    }

    public function studentShiftUpdate(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|unique:student_shifts'
        ],
        [
            'name.unique' => 'You have already chosen this shift!'
        ]);

        $class = StudentShift::find($id);

        $class->update([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Student Shift Successfully Updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.shift.view')->with($notification); 
    }

    public function studentShiftDelete($id){
        $class = StudentShift::findOrFail($id);
        $class->delete();

        $notification = [
            'message' => 'Student Shift Successfully Deleted',
            'alert-type' => 'info'
        ];

        return redirect()->route('student.shift.view')->with($notification);   
    }
}
