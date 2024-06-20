<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\StudentGroup;

class StudentGroupController extends Controller
{
    public function studentGroupView(){
        $datas = StudentGroup::orderBy('name', 'desc')->get();

        return view('backend.setup.group.view_group', [
            'datas' => $datas
        ]);
    }

    public function studentGroupAdd(){
        return view('backend.setup.group.add_group');
    }

    public function studentGroupStore(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:student_groups'
        ]);

        StudentGroup::create([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Student Group Successfully Inserted',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.group.view')->with($notification);
    }

    public function studentGroupEdit($id){
        $edit_class = StudentGroup::findOrFail($id);

        return view('backend.setup.group.edit_group', [
            'edit_class' => $edit_class
        ]);
    }

    public function studentGroupUpdate(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|unique:student_groups'
        ],
        [
            'name.unique' => 'You have already chosen this group!'
        ]);

        $class = StudentGroup::find($id);

        $class->update([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Student Group Successfully Updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.group.view')->with($notification); 
    }

    public function studentGroupDelete($id){
        $class = StudentGroup::findOrFail($id);
        $class->delete();

        $notification = [
            'message' => 'Student Group Successfully Deleted',
            'alert-type' => 'info'
        ];

        return redirect()->route('student.group.view')->with($notification);   
    }
}
