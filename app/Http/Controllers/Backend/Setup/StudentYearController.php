<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentYear;

class StudentYearController extends Controller
{
    public function studentYearView(){
        $datas = StudentYear::orderBy('name', 'desc')->get();

        return view('backend.setup.year.view_year', [
            'datas' => $datas
        ]);
    }

    public function studentYearAdd(){
        return view('backend.setup.year.add_year');
    }

    public function studentYearStore(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:student_years'
        ]);

        StudentYear::create([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Student Year Successfully Inserted',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.year.view')->with($notification);
    }

    public function studentYearEdit($id){
        $edit_class = StudentYear::findOrFail($id);

        return view('backend.setup.year.edit_year', [
            'edit_class' => $edit_class
        ]);
    }

    public function studentYearUpdate(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|unique:student_years'
        ],
        [
            'name.unique' => 'You have already chosen this year!'
        ]);

        $class = StudentYear::find($id);

        $class->update([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Student Year Successfully Updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.year.view')->with($notification); 
    }

    public function studentYearDelete($id){
        $class = StudentYear::findOrFail($id);
        $class->delete();

        $notification = [
            'message' => 'Student Year Successfully Deleted',
            'alert-type' => 'info'
        ];

        return redirect()->route('student.year.view')->with($notification);   
    }
}
