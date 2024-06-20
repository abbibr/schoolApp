<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FeeCategory;

class FeeCategoryController extends Controller
{
    public function FeeView(){
        $datas = FeeCategory::orderBy('name', 'desc')->get();

        return view('backend.setup.fee_categories.view_fee', [
            'datas' => $datas
        ]);
    }

    public function FeeAdd(){
        return view('backend.setup.fee_categories.add_fee');
    }

    public function FeeStore(Request $request){
        $this->validate($request, [
            'name' => 'required|unique:fee_categories'
        ]);

        FeeCategory::create([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Fee Category Successfully Inserted',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.fee.view')->with($notification);
    }

    public function FeeEdit($id){
        $edit_class = FeeCategory::findOrFail($id);

        return view('backend.setup.fee_categories.edit_fee', [
            'edit_class' => $edit_class
        ]);
    }

    public function FeeUpdate(Request $request, $id){
        $this->validate($request, [
            'name' => 'required|unique:fee_categories'
        ],
        [
            'name.unique' => 'You have already chosen this fee category!'
        ]);

        $class = FeeCategory::find($id);

        $class->update([
            'name' => $request->name
        ]);

        $notification = [
            'message' => 'Fee Category Successfully Updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.fee.view')->with($notification); 
    }

    public function FeeDelete($id){
        $class = FeeCategory::findOrFail($id);
        $class->delete();

        $notification = [
            'message' => 'Fee Category Successfully Deleted',
            'alert-type' => 'info'
        ];

        return redirect()->route('student.fee.view')->with($notification);   
    }
}
