<?php

namespace App\Http\Controllers\Backend\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\AssignStudent;
use App\Models\DiscountStudent;

use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\StudentGroup;
use App\Models\StudentShift;
use DB, Hash, Storage;
use Barryvdh\DomPDF\Facade\PDF;

class StudentRegController extends Controller
{
    public function StudentRegView(){
        $years = StudentYear::all();
        $classes = StudentClass::all();

        $year_id = StudentYear::orderBy("id","desc")->first()->id;
        $class_id = StudentClass::orderBy("id","desc")->first()->id;

        $datas = AssignStudent::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->get();

        return view('backend.student.student_registration.student_view', [
            'datas' => $datas,
            'years' => $years,
            'classes' => $classes,
            'year_id' => $year_id,
            'class_id' => $class_id
        ]);
    }

    public function StudentRegAdd(){
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $groups = StudentGroup::all();
        $shifts = StudentShift::all();

        return view('backend.student.student_registration.student_add', [
            'years' => $years,
            'classes' => $classes,
            'groups' => $groups,
            'shifts' => $shifts
        ]);
    }

    public function StudentRegStore(Request $request){
        DB::transaction(function () use($request) {
            $student = User::where('usertype', 'student')->first();
            $checkYear = StudentYear::find($request->year_id)->name;

            // Unique ID_No for students...
            if ($student == null) {
                $firstReg = 0;
                $studentId = $firstReg + 1;

                if ($studentId < 10) {
                    $id_no = '000'.$studentId;
                }
                elseif ($studentId < 100) {
                    $id_no = '00'.$studentId;
                }
                elseif ($studentId < 1000) {
                    $id_no = '0'.$studentId;
                }
            }
            else {
                $student = User::where('usertype', 'student')->latest()->first()->id;
                $studentId = $student + 1;

                if ($studentId < 10) {
                    $id_no = '000'.$studentId;
                }
                elseif ($studentId < 100) {
                    $id_no = '00'.$studentId;
                }
                elseif ($studentId < 1000) {
                    $id_no = '0'.$studentId;
                }
            }

            $final_id_no = $checkYear.$id_no;
            $code = rand(00000, 99999);

            $file = $request->file('image');
            $name = date('YmdHi').$file->getClientOriginalName();
            $path = $file->storeAs('students/profiles', $name);


            // Save datas of Students in Users table
            $user = new User();
            $user->id_no = $final_id_no;
            $user->password = Hash::make($code);
            $user->usertype = 'student';
            $user->email = 'someone123@gmail.com';
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->image = $path;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            $user->save();


            // Save datas of Students in Assign Students table
            $assign_student = new AssignStudent();
            $assign_student->student_id = $user->id;
            $assign_student->class_id = $request->class_id;
            $assign_student->year_id = $request->year_id;
            $assign_student->group_id = $request->group_id;
            $assign_student->shift_id = $request->shift_id;
            $assign_student->save();


            // Save datas of Students in Discount Students table
            $discount_student = new DiscountStudent();
            $discount_student->assign_student_id = $assign_student->id;
            $discount_student->fee_category_id = '1';
            $discount_student->discount = $request->discount;
            $discount_student->save();
        });

        $notification = [
            'message' => 'New Student Successfully Inserted',
            'alert-type' => 'success'
        ];

        return redirect()->route('student.registration.view')->with($notification);
    }

    public function StudentSearch(Request $request){
        $years = StudentYear::all();
        $classes = StudentClass::all();

        $year_id = StudentYear::orderBy("id","desc")->find($request->year_id)->id;
        $class_id = StudentClass::orderBy("id","desc")->find($request->class_id)->id;

        $datas = AssignStudent::where('year_id', $year_id)
            ->where('class_id', $class_id)
            ->get();

        return view('backend.student.student_registration.student_view', [
            'datas' => $datas,
            'years' => $years,
            'classes' => $classes,
            'year_id' => $year_id,
            'class_id' => $class_id
        ]);
    }

    public function StudentEdit($id) {
        $edit_student = AssignStudent::find($id);
        $years = StudentYear::all();
        $classes = StudentClass::all();
        $groups = StudentGroup::all();
        $shifts = StudentShift::all();
        
        return view('backend.student.student_registration.student_edit', [
            'edit_student' => $edit_student,
            'years' => $years,
            'classes' => $classes,
            'groups' => $groups,
            'shifts' => $shifts
        ]);
    }

    public function StudentUpdate(Request $request, $id) {
        $update_student = AssignStudent::find($id);
        $student_user= User::where('id', $update_student->student_id)->first();
        $discount = DiscountStudent::where('assign_student_id', $update_student->id)->first();

        $file = $request->file('image');

        if (!empty($file)) {
            if (Storage::exists($student_user->image)) {
                unlink("storage/".$student_user->image);
            }
            
            $name = date('YmdHi').$file->getClientOriginalName();
            $path = $file->storeAs('students/profiles', $name);

            $update_student->update([
                'class_id' => $request->class_id,
                'year_id' => $request->year_id,
                'group_id' => $request->group_id,
                'shift_id' => $request->shift_id
            ]);

            $student_user->update([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'gender' => $request->gender,
                'fname' => $request->fname,
                'mname' => $request->mname,
                'religion' => $request->religion,
                'dob' => date('Y-m-d', strtotime($request->dob)),
                'image' => $path,
            ]);

            $discount->update([
                'discount' => $request->discount
            ]);

            $notification = [
                'message' => 'Student Data Successfully Updated',
                'alert-type' => 'success'
            ];
    
            return redirect()->route('student.registration.view')->with($notification);
        }
        else {
            $update_student->update([
                'class_id' => $request->class_id,
                'year_id' => $request->year_id,
                'group_id' => $request->group_id,
                'shift_id' => $request->shift_id
            ]);
    
            $student_user->update([
                'name' => $request->name,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'gender' => $request->gender,
                'fname' => $request->fname,
                'mname' => $request->mname,
                'religion' => $request->religion,
                'dob' => date('Y-m-d', strtotime($request->dob))
            ]);
    
            $discount->update([
                'discount' => $request->discount
            ]);
    
            $notification = [
                'message' => 'Student Data Successfully Updated without Profile Image',
                'alert-type' => 'success'
            ];
    
            return redirect()->route('student.registration.view')->with($notification);
        }
    }

    public function StudentPdfDetails($id) {
        $assign_student = AssignStudent::find($id);
        $user_student = User::where('id', $assign_student->student_id)->first();

        $pdf = Pdf::loadView('backend.student.student_registration.student_pdf_details', [
            'assign_student' => $assign_student
        ]);

        return $pdf->download("$user_student->name/details.pdf");
    }

}
