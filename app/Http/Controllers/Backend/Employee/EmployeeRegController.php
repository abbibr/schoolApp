<?php

namespace App\Http\Controllers\Backend\Employee;

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

use App\Models\Designation;
use App\Models\EmployeeSalary;

class EmployeeRegController extends Controller
{
    public function employeeView()
    {
        $datas = User::where('usertype', 'employee')->get();

        return view('backend.employee.employee_reg.employee_view', [
            'datas' => $datas
        ]);
    }

    public function employeeAdd()
    {
        $designations = Designation::all();

        return view('backend.employee.employee_reg.employee_add', [
            'designations' => $designations
        ]);
    }

    public function employeeStore(Request $request)
    {
        DB::transaction(function () use ($request) {
            $employee = User::where('usertype', 'employee')->latest()->first();
            $checkYear = date('Ym', strtotime($request->join_date));

            // Unique ID_No for students...
            if ($employee == null) {
                $firstReg = 0;
                $employeeId = $firstReg + 1;

                if ($employeeId < 10) {
                    $id_no = '000' . $employeeId;
                } elseif ($employeeId < 100) {
                    $id_no = '00' . $employeeId;
                } elseif ($employeeId < 1000) {
                    $id_no = '0' . $employeeId;
                }
            } else {
                $employee = User::where('usertype', 'employee')->latest()->first()->id;
                $employeeId = $employee + 1;

                if ($employeeId < 10) {
                    $id_no = '000' . $employeeId;
                } elseif ($employeeId < 100) {
                    $id_no = '00' . $employeeId;
                } elseif ($employeeId < 1000) {
                    $id_no = '0' . $employeeId;
                }
            }

            $final_id_no = $checkYear . $id_no;
            $code = rand(00000, 99999);

            $file = $request->file('image');
            $name = date('YmdHi') . $file->getClientOriginalName();
            $path = $file->storeAs('employees/images', $name);


            // Save datas of Students in Users table
            $user = new User();
            $user->id_no = $final_id_no;
            $user->password = Hash::make($code);
            $user->usertype = 'employee';
            $user->email = $request->email;
            $user->code = $code;
            $user->name = $request->name;
            $user->fname = $request->fname;
            $user->mname = $request->mname;
            $user->mobile = $request->mobile;
            $user->address = $request->address;
            $user->gender = $request->gender;
            $user->religion = $request->religion;
            $user->salary = $request->salary;
            $user->designation_id = $request->designation_id;
            $user->join_date = date('Y-m-d', strtotime($request->join_date));
            $user->image = $path;
            $user->dob = date('Y-m-d', strtotime($request->dob));
            $user->save();


            // Save datas of Students in Assign Students table
            $employee_salary = new EmployeeSalary();
            $employee_salary->employee_id = $user->id;
            $employee_salary->effected_salary = date('Y-m-d', strtotime($request->dob));
            $employee_salary->previous_salary = $request->salary;
            $employee_salary->present_salary = $request->salary;
            $employee_salary->increment_salary = '0';
            $employee_salary->save();
        });

        $notification = [
            'message' => 'New Employee Successfully Inserted',
            'alert-type' => 'success'
        ];

        return redirect()->route('employee.registration.view')->with($notification);
    }

    public function employeeEdit($id)
    {
        $employee = User::findOrFail($id);
        $designations = Designation::all();

        return view('backend.employee.employee_reg.employee_edit', [
            'employee' => $employee,
            'designations' => $designations
        ]);
    }

    public function employeeUpdate(Request $request, $id)
    {
        $employee_user = User::findOrFail($id);
        $employee_salary = $employee_user->employee_salary[0];

        $file = $request->file('image');

        if(!empty($file)) {
            if(Storage::exists($employee_user->image)) {
                unlink("storage/$employee_user->image");
            }

            $name = date('YmdHi').$file->getClientOriginalName();
            $path = $file->storeAs('employees/images', $name);

            $employee_user->update([
                'email' => $request->email,
                'name' => $request->name,
                'fname' => $request->fname,
                'mname' => $request->mname,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'gender' => $request->email,
                'religion' => $request->religion,
                'salary' => $request->salary,
                'designation_id' => $request->designation_id,
                'join_date' => $request->join_date,
                'image' => $path,
                'dob' => $request->dob,
            ]);

            $employee_salary->update([
                'effected_salary' => date('Y-m-d', strtotime($request->dob)),
                'previous_salary' => $request->salary,
                'present_salary' => $request->salary,
                'increment_salary' => '0'
            ]);

            $notification = [
                'message' => 'Employee Successfully Updated with Profile Image',
                'alert-type' => 'success'
            ];
    
            return redirect()->route('employee.registration.view')->with($notification);
        }
        else {
            $employee_user->update([
                'email' => $request->email,
                'name' => $request->name,
                'fname' => $request->fname,
                'mname' => $request->mname,
                'mobile' => $request->mobile,
                'address' => $request->address,
                'gender' => $request->email,
                'religion' => $request->religion,
                'salary' => $request->salary,
                'designation_id' => $request->designation_id,
                'join_date' => $request->join_date,
                'dob' => $request->dob,
            ]);

            $employee_salary->update([
                'effected_salary' => date('Y-m-d', strtotime($request->dob)),
                'previous_salary' => $request->salary,
                'present_salary' => $request->salary,
                'increment_salary' => '0'
            ]);

            $notification = [
                'message' => 'Employee Successfully Updated',
                'alert-type' => 'success'
            ];
    
            return redirect()->route('employee.registration.view')->with($notification);
        }
    }

    public function employeeDelete($id) {
        $employee_user = User::findOrFail($id);
        $employee_salary = EmployeeSalary::where('employee_id', $id)->first();
        
        $employee_user->delete();
        $employee_salary->delete();

        $notification = [
            'message' => 'Employee Successfully Deleted',
            'alert-type' => 'info'
        ];

        return back()->with($notification);
    }

    public function employeeDetails($id) {
        $employee_user = User::findOrFail($id);
        $pdf = PDF::loadView('backend.employee.employee_reg.employee_pdf', [
            'employee_user' => $employee_user
        ]);

        return $pdf->download('detailsEmployee/'.$employee_user->name.".pdf");
    }
}
