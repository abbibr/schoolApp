<?php

use App\Http\Controllers\Backend\Employee\EmployeeAttendanceController;
use App\Http\Controllers\backend\employee\EmployeeLeaveController;
use App\Http\Controllers\Backend\Employee\EmployeeRegController;
use App\Http\Controllers\Backend\Employee\EmployeeSalaryController;
use App\Http\Controllers\Backend\Employee\MonthlySalaryController;
use App\Http\Controllers\Backend\Marks\MarksController;
use App\Http\Controllers\Backend\Setup\AssignSubjectController;
use App\Http\Controllers\Backend\Setup\DesignationController;
use App\Http\Controllers\Backend\Setup\FeeCategoryAmountController;
use App\Http\Controllers\Backend\Setup\FeeCategoryController;
use App\Http\Controllers\Backend\Setup\StudentClassController;
use App\Http\Controllers\Backend\Setup\StudentExamController;
use App\Http\Controllers\Backend\Setup\StudentGroupController;
use App\Http\Controllers\Backend\Setup\StudentShiftController;
use App\Http\Controllers\Backend\Setup\StudentSubjectController;
use App\Http\Controllers\Backend\Setup\StudentYearController;
use App\Http\Controllers\Backend\Student\ExamFeeController;
use App\Http\Controllers\Backend\Student\MonthlyFeeController;
use App\Http\Controllers\Backend\Student\StudentRegController;
use App\Http\Controllers\Backend\Student\StudentRoleController;
use App\Http\Controllers\Backend\Student\RegistrationFeeController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\ProfileController;


Route::get('/', function () {
    return view('auth.login');
})->middleware('guest');

Route::middleware(['auth:sanctum', 'verified', config('jetstream.auth_session')])->group(function(){
    Route::prefix('/admin')->group(function(){
        Route::get('/dashboard', function() {
            return view('admin.index');
        })->name('dashboard');
    });
});

Route::middleware('auth')->group(function() {
    // admin panel
    Route::prefix('/admin')->group(function(){
        Route::middleware('auth')->group(function(){
            Route::controller(AdminController::class)->group(function(){
                Route::get('/logout', 'logout')->name('admin.logout');
            });
        });
    });


    // user management
    Route::prefix('/admin/users')->group(function(){
        Route::controller(UserController::class)->group(function(){
            Route::get('/view', 'viewUser')->name('user.view');
            Route::get('/add', 'addUser')->name('user.add');
            Route::post('/store', 'storeUser')->name('user.store');
            Route::get('/edit/{id}', 'editUser')->name('user.edit');
            Route::post('/update/{id}', 'updateUser')->name('user.update');
            Route::get('/delete/{id}', 'deleteUser')->name('user.delete');
        });
    });


    // user profile and password
    Route::prefix('/admin/profile/')->group(function(){
        Route::controller(ProfileController::class)->group(function(){
            Route::get('/view', 'profileView')->name('profile.view');
            Route::get('/edit', 'profileEdit')->name('profile.edit');
            Route::post('/update', 'profileUpdate')->name('profile.update');
            Route::get('/change/password', 'changePassword')->name('change.password');
            Route::post('/store/password', 'storePassword')->name('store.password');
        });
    });


    // Setup Manage Part
    Route::prefix('/admin/setups/')->group(function(){
        Route::controller(StudentClassController::class)->group(function(){
            Route::get('/student/class/view', 'studentView')->name('student.class.view');
            Route::get('/student/class/add', 'studentClassAdd')->name('student.class.add');
            Route::post('/student/class/store', 'studentClassStore')->name('student.class.store');
            Route::get('/student/class/edit/{id}', 'studentClassEdit')->name('student.class.edit');
            Route::post('/student/class/update/{id}', 'studentClassUpdate')->name('student.class.update');
            Route::get('/student/class/delete/{id}', 'studentclassDelete')->name('student.class.delete');
        });

        Route::controller(StudentYearController::class)->group(function(){
            Route::get('/student/year/view', 'studentYearView')->name('student.year.view');
            Route::get('/student/year/add', 'studentYearAdd')->name('student.year.add');
            Route::post('/student/year/store', 'studentYearStore')->name('student.year.store');
            Route::get('/student/year/edit/{id}', 'studentYearEdit')->name('student.year.edit');
            Route::post('/student/year/update/{id}', 'studentYearUpdate')->name('student.year.update');
            Route::get('/student/year/delete/{id}', 'studentYearDelete')->name('student.year.delete');
        });

        Route::controller(StudentGroupController::class)->group(function(){
            Route::get('/student/group/view', 'studentGroupView')->name('student.group.view');
            Route::get('/student/group/add', 'studentGroupAdd')->name('student.group.add');
            Route::post('/student/group/store', 'studentGroupStore')->name('student.group.store');
            Route::get('/student/group/edit/{id}', 'studentGroupEdit')->name('student.group.edit');
            Route::post('/student/group/update/{id}', 'studentGroupUpdate')->name('student.group.update');
            Route::get('/student/group/delete/{id}', 'studentGroupDelete')->name('student.group.delete');
        });

        Route::controller(StudentShiftController::class)->group(function(){
            Route::get('/student/shift/view', 'studentShiftView')->name('student.shift.view');
            Route::get('/student/shift/add', 'studentShiftAdd')->name('student.shift.add');
            Route::post('/student/shift/store', 'studentShiftStore')->name('student.shift.store');
            Route::get('/student/shift/edit/{id}', 'studentShiftEdit')->name('student.shift.edit');
            Route::post('/student/shift/update/{id}', 'studentShiftUpdate')->name('student.shift.update');
            Route::get('/student/shift/delete/{id}', 'studentShiftDelete')->name('student.shift.delete');
        });

        Route::controller(FeeCategoryController::class)->group(function(){
            Route::get('/student/fee/view', 'FeeView')->name('student.fee.view');
            Route::get('/student/fee/add', 'FeeAdd')->name('student.fee.add');
            Route::post('/student/fee/store', 'FeeStore')->name('student.fee.store');
            Route::get('/student/fee/edit/{id}', 'FeeEdit')->name('student.fee.edit');
            Route::post('/student/fee/update/{id}', 'FeeUpdate')->name('student.fee.update');
            Route::get('/student/fee/delete/{id}', 'FeeDelete')->name('student.fee.delete');
        });
        
        Route::controller(FeeCategoryAmountController::class)->group(function(){
            Route::get('/fee/amount/view', 'feeAmountView')->name('fee.amount.view');
            Route::get('/fee/amount/add', 'feeAmountAdd')->name('fee.amount.add');
            Route::post('/fee/amount/store', 'feeAmountStore')->name('fee.amount.store');
            Route::get('/fee/amount/edit/{fee_category_id}', 'feeAmountEdit')->name('fee.amount.edit');
            Route::post('/fee/amount/update/{fee_category_id}', 'feeAmountUpdate')->name('fee.amount.update');
            Route::get('/fee/amount/details/{fee_category_id}', 'feeAmountDetails')->name('fee.amount.details');
        });

        Route::controller(StudentExamController::class)->group(function(){
            Route::get('/student/exam/view', 'studentExamView')->name('student.exam.view');
            Route::get('/student/exam/add', 'studentExamAdd')->name('student.exam.add');
            Route::post('/student/exam/store', 'studentExamStore')->name('student.exam.store');
            Route::get('/student/exam/edit/{id}', 'studentExamEdit')->name('student.exam.edit');
            Route::post('/student/exam/update/{id}', 'studentExamUpdate')->name('student.exam.update');
            Route::get('/student/exam/delete/{id}', 'studentExamDelete')->name('student.exam.delete');
        });

        Route::controller(StudentSubjectController::class)->group(function(){
            Route::get('/student/subject/view', 'StudentSubjectView')->name('student.subject.view');
            Route::get('/student/subject/add', 'StudentSubjectAdd')->name('student.subject.add');
            Route::post('/student/subject/store', 'StudentSubjectStore')->name('student.subject.store');
            Route::get('/student/subject/edit/{id}', 'StudentSubjectEdit')->name('student.subject.edit');
            Route::post('/student/subject/update/{id}', 'StudentSubjectUpdate')->name('student.subject.update');
            Route::get('/student/subject/delete/{id}', 'StudentSubjectDelete')->name('student.subject.delete');
        });

        Route::controller(AssignSubjectController::class)->group(function(){
            Route::get('/assign/subject/view', 'assignSubjectView')->name('assign.subject.view');
            Route::get('/assign/subject/add', 'assignSubjectAdd')->name('assign.subject.add');
            Route::post('/assign/subject/store', 'assignSubjectStore')->name('assign.subject.store');
            Route::get('/assign/subject/edit/{class_id}', 'assignSubjectEdit')->name('assign.subject.edit');
            Route::post('/assign/subject/update/{class_id}', 'assignSubjectUpdate')->name('assign.subject.update');
            Route::get('/assign/subject/details/{class_id}', 'assignSubjectDetails')->name('assign.subject.details');
        });

        Route::controller(DesignationController::class)->group(function(){
            Route::get('/designation/view', 'DesignationView')->name('designation.view');
            Route::get('/designation/add', 'DesignationAdd')->name('designation.add');
            Route::post('/designation/store', 'DesignationStore')->name('designation.store');
            Route::get('/designation/edit/{id}', 'DesignationEdit')->name('designation.edit');
            Route::post('/designation/update/{id}', 'DesignationUpdate')->name('designation.update');
            Route::get('/designation/delete/{id}', 'Designationdelete')->name('designation.delete');
        });
    });


    // Student Management Part
    Route::prefix('/admin/students/')->group(function() {
        Route::controller(StudentRegController::class)->group(function(){
            Route::get('/registration/view', 'StudentRegView')->name('student.registration.view');
            Route::get('/registration/add', 'StudentRegAdd')->name('student.registration.add');
            Route::post('/registration/store', 'StudentRegStore')->name('student.registration.store');
            Route::get('/year/class/search', 'StudentSearch')->name('student.year.class.data');
            Route::get('/registration/edit/{id}', 'StudentEdit')->name('student.registration.edit');
            Route::post('/registration/update/{id}', 'StudentUpdate')->name('student.registration.update');
            Route::get('/registration/details/{id}', 'StudentPdfDetails')->name('student.registration.details');
        });

        Route::controller(StudentRoleController::class)->group(function() {
            Route::get('/role/generate/view', 'StudentRoleView')->name('role.generate.view');
            Route::get('/role/generate/getstudent', 'StudentRole')->name('student.role.generate');
            Route::post('/role/generate/store', 'StudentRoleInsert')->name('student.role.store');
        });

        Route::controller(RegistrationFeeController::class)->group(function() {
            Route::get('/registration/fee/view', 'feeView')->name('registration.fee.view');
            Route::get('/registration/fee/generate', 'feeGenerate')->name('registration.fee.generate');
            Route::get('/registration/pdf/generate', 'pdfGenerate')->name('student.registration.fee.payslip');
        });

        Route::controller(MonthlyFeeController::class)->group(function() {
            Route::get('/month/fee/view', 'feeView')->name('month.fee.view');
            Route::get('/month/fee/generate', 'feeGenerate')->name('month.fee.generate');
            Route::get('/month/pdf/generate', 'pdfGenerate')->name('month.pdf.generate');
        });

        Route::controller(ExamFeeController::class)->group(function() {
            Route::get('/exam/fee/view', 'feeView')->name('exam.fee.view');
            Route::get('/exam/fee/generate', 'feeGenerate')->name('exam.fee.generate');
            Route::get('/exam/pdf/generate', 'feePdf')->name('exam.pdf.generate');
        });
    });


    // Employee Part (Registration, Salary, Attendance...)
    Route::prefix('/admin/employees')->group(function() {
        // Employee Registration 
        Route::controller(EmployeeRegController::class)->group(function() {
            Route::get('/registration/view', 'employeeView')->name('employee.registration.view');
            Route::get('/registration/add', 'employeeAdd')->name('employee.registration.add');
            Route::post('/registration/store', 'employeeStore')->name('employee.registration.store');
            Route::get('/registration/edit/{id}', 'employeeEdit')->name('employee.registration.edit');
            Route::post('/registration/update/{id}', 'employeeUpdate')->name('employee.registration.update');
            Route::get('/registration/delete/{id}', 'employeeDelete')->name('employee.registration.delete');
            Route::get('/registration/details/{id}', 'employeeDetails')->name('employee.registration.details');
            Route::get('/registration/lists', 'employeeLists')->name('employee.registration.lists');
        });

        // Employee Salary
        Route::controller(EmployeeSalaryController::class)->group(function() {
            Route::get('/salary/view', 'salaryView')->name('employee.salary.view');
            Route::get('/salary/increment/{id}', 'salaryIncrement')->name('employee.salary.increment');
            Route::post('/salary/update/{id}', 'salaryUpdate')->name('employee.increment.update');
            Route::get('/salary/details/{id}', 'salaryDetails')->name('employee.salary.details');
        });

        // Employee Leave
        Route::controller(EmployeeLeaveController::class)->group(function() {
            Route::get('/leave/view', 'leaveView')->name('employee.leave.view');
            Route::get('/leave/add', 'leaveAdd')->name('employee.leave.add');
            Route::post('/leave/store', 'leaveStore')->name('employee.leave.store');
            Route::get('/leave/edit/{id}', 'leaveEdit')->name('employee.leave.edit');
            Route::post('/leave/update/{id}', 'leaveUpdate')->name('employee.leave.update');
        });

        // Employee Attendance
        Route::controller(EmployeeAttendanceController::class)->group(function() {
            Route::get('/attendance/view', 'attendanceView')->name('employee.attendance.view');
            Route::get('/attendance/add', 'attendanceAdd')->name('employee.attendance.add');
            Route::post('/attendance/store', 'attendanceStore')->name('employee.attendance.store');
            Route::get('/attendance/details/{date}', 'attendanceDetails')->name('employee.attendance.details');
            Route::get('/attendance/edit/{date}', 'attendanceEdit')->name('employee.attendance.edit');
            Route::post('/attendance/update/{date}', 'attendanceUpdate')->name('employee.attendance.update');
        });

        // Employee Monthly Salary belongs to Attendance
        Route::controller(MonthlySalaryController::class)->group(function() {
            Route::get('/monthly/salary/view', 'monthlyView')->name('employee.monthly.salary');
            Route::get('/monthly/salary/attendance', 'monthlyAttendance')->name('employee.monthly.attendance');
            Route::get('/monthly/salary/payslip/{user_id}', 'monthlyPaySlip')->name('employee.monthly.salary.payslip');
        });
    });


    // Student Marks Entry
    Route::prefix('/admin/marks')->group(function() {
        Route::controller(MarksController::class)->group(function() {
            Route::get('/entry/add', 'marksAdd')->name('marks.entry.add');
            Route::get('/entry/getSubject', 'marksGetSubject')->name('marks.entry.subject');
            Route::get('entry/getStudent', 'marksGetStudent')->name('marks.entry.student');
        });
    });
});
