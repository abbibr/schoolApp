<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Designation;

class DesignationController extends Controller
{
    public function DesignationView(){
        $datas = Designation::all();

        return view('backend.setup.designation.view_designation', [
            'datas' => $datas
        ]);
    }

    public function DesignationAdd(){
        return view('backend.setup.designation.add_designation');
    }

    public function DesignationStore(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:designations'
        ]);

        Designation::create([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Designation Successfully Inserted',
            'alert-type' => 'success'
        ];

        return redirect()->route('designation.view')->with($notification);
    }

    public function DesignationEdit($id){
        $edit_class = Designation::findOrFail($id);

        return view('backend.setup.designation.edit_designation', [
            'edit_class' => $edit_class
        ]);
    }

    public function DesignationUpdate(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|unique:designations'
        ],
        [
            'name.unique' => 'You have already chosen this designation!'
        ]);

        $class = Designation::find($id);

        $class->update([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Designation Successfully Updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('designation.view')->with($notification); 
    }

    public function DesignationDelete($id){
        $class = Designation::findOrFail($id);
        $class->delete();

        $notification = [
            'message' => 'Designation Successfully Deleted',
            'alert-type' => 'info'
        ];

        return redirect()->route('designation.view')->with($notification);   
    }
}
