<?php

namespace App\Http\Controllers\Backend\Setup;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AssignSubject;
use App\Models\StudentClass;
use App\Models\StudentSubject;

class AssignSubjectController extends Controller
{
    public function assignSubjectView(){
        $datas = AssignSubject::select('class_id')
                    ->groupBy('class_id')
                    ->get();

        return view('backend.setup.assign_subject.view_assign_subjec    t', [
            'datas' => $datas
        ]);
    }

    public function assignSubjectAdd(){
        $classes = StudentClass::all();
        $subjects = StudentSubject::all();

        return view('backend.setup.assign_subject.add_assign_subject', [
            'classes' => $classes,
            'subjects' => $subjects
        ]);
    }

    public function assignSubjectStore(Request $request){
        $this->validate($request, [
            'class_id' => 'required',
            'subject_id' => 'required',
        ], 
        [
            'class_id.required' => 'Please, select any class!',
            'subject_id.required' => 'Please, select any subject!'
        ]);

        $subjects = $request->subject_id;
        $full_marks = $request->full_mark;
        $pass_marks = $request->pass_mark;
        $subjective_marks = $request->subjective_mark;

        foreach ($subjects as $key => $subject) {
            $full_mark = $full_marks[$key];
            $pass_mark = $pass_marks[$key];
            $subjective_mark = $subjective_marks[$key];

            if(AssignSubject::whereRaw("class_id = $request->class_id AND subject_id = $subject")->exists()){
                $notification = [
                    'message' => 'You have already inserted this data!',
                    'alert-type' => 'error'
                ];
        
                return redirect()->back()->with($notification);
            }
            else
            {                
                AssignSubject::create([
                    'class_id' => $request->class_id,
                    'subject_id' => $subject,
                    'full_mark' => $full_mark,
                    'pass_mark' => $pass_mark,
                    'subjective_mark' => $subjective_mark,
                ]);
            }
        }

        $notification = [
            'message' => 'Assign Marks Successfully Inserted',
            'alert-type' => 'success'
        ];

        return redirect()->route('assign.subject.view')->with($notification);
    }

    public function assignSubjectEdit($class_id){
        $edit_assign = AssignSubject::where('class_id', $class_id)->get();
        $classes = StudentClass::all();
        $subjects = StudentSubject::all();
        
        return view('backend.setup.assign_subject.edit_assign', [
            'edit_assign' => $edit_assign,
            'classes' => $classes,
            'subjects' => $subjects
        ]);
    }

    public function assignSubjectUpdate($class_id, Request $request){
        $class = $request->class_id;
        $subjects = $request->subject_id;
        $full_marks = $request->full_mark;
        $pass_marks = $request->pass_mark;
        $subjective_marks = $request->subjective_mark;

        if(empty($subjects)){
            $notification = [
                'message' => 'You need to select any student subject!',
                'alert-type' => 'error'
            ];

            return redirect()->back()->with($notification);
        }
        else
        {
            $delete_assign = AssignSubject::where('class_id', $class_id)->delete();

            foreach ($subjects as $key => $subject) {
                $full_mark = $full_marks[$key];
                $pass_mark = $pass_marks[$key];
                $subjective_mark = $subjective_marks[$key];

                $update_assign = new AssignSubject();
                $update_assign->class_id = $class;
                $update_assign->subject_id = $subject;
                $update_assign->full_mark = $full_mark;
                $update_assign->pass_mark = $pass_mark;
                $update_assign->subjective_mark = $subjective_mark;
                $update_assign->save();
            }
        }

        $notification = [
            'message' => 'Assign Subject Successfully Updated',
            'alert-type' => 'success'
        ];

        return redirect()->route('assign.subject.view')->with($notification);
    }

    public function assignSubjectDetails($class_id){
        $datas = AssignSubject::where('class_id', $class_id)->get();

        return view('backend.setup.assign_subject.details_assign', [
            'datas' => $datas
        ]);
    }
}
