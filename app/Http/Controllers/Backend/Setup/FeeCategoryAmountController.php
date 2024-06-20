<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;

use App\Models\FeeCategoryAmount;
use App\Models\FeeCategory;
use App\Models\StudentClass;


class FeeCategoryAmountController extends Controller
{
    public function feeAmountView()
    {
        $datas = FeeCategoryAmount::select('fee_category_id')
            ->groupBy('fee_category_id')
            ->get();

        return view('backend.setup.fee_amount.view_fee_amount', [
            'datas' => $datas
        ]);
    }

    public function feeAmountAdd()
    {
        $categories = FeeCategory::all();
        $classes = StudentClass::all();

        return view('backend.setup.fee_amount.add_fee_amount', [
            'categories' => $categories,
            'classes' => $classes
        ]);
    }

    public function feeAmountStore(Request $request)
    {
        $this->validate(
            $request,
            [
                'category_id' => 'required',
                'class_id' => 'required',
                'amount' => 'required'
            ],
            [
                'category_id.required' => 'Fee Category is required',
                'class_id.required' => 'Student Class is required',
                'amount.required' => 'Amount is required',
            ]
        );

        $classes = $request->class_id;
        $amounts = $request->amount;

        foreach ($classes as $key => $class) {
            $amount = $amounts[$key];

            FeeCategoryAmount::create([
                'fee_category_id' => $request->category_id,
                'student_class_id' => $class,
                'amount' => $amount
            ]);
        }

        $notification = [
            'message' => 'Fee Amount Successfully Inserted',
            'alert-type' => 'success'
        ];

        return redirect()->route('fee.amount.view')->with($notification);
    }

    public function feeAmountEdit($fee_category_id)
    {
        $edit_data = FeeCategoryAmount::where('fee_category_id', $fee_category_id)
            ->orderBy('student_class_id', 'asc')
            ->get();

        $categories = FeeCategory::all();
        $classes = StudentClass::all();

        return view('backend.setup.fee_amount.edit_fee_amount', [
            'edit_data' => $edit_data,
            'categories' => $categories,
            'classes' => $classes
        ]);
    }

    public function feeAmountUpdate(Request $request, $fee_category_id){
        if(empty($request->class_id)){
            $notification = [
                'message' => 'You need to select any class amount!',
                'alert-type' => 'error'
            ];
    
            return redirect()->back()->with($notification);
        }
        else
        {
            $classes = $request->class_id;
            $amounts = $request->amount;

            FeeCategoryAmount::where('fee_category_id', $fee_category_id)->delete();

            foreach ($classes as $key => $class) {
                $amount = $amounts[$key];

                $update = new FeeCategoryAmount();
                $update->fee_category_id = $request->category_id;
                $update->student_class_id = $class;
                $update->amount = $amount;
                $update->save();
            }
        }

        $notification = [
            'message' => 'Fee Amount Successfully Updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('fee.amount.view')->with($notification);
    }

    public function feeAmountDetails($fee_category_id){
        $details = FeeCategoryAmount::where('fee_category_id', $fee_category_id)
                        ->orderBy('student_class_id', 'asc')
                        ->get();

        return view('backend.setup.fee_amount.details_fee_amount', [
            'details' => $details
        ]);
    }
}
