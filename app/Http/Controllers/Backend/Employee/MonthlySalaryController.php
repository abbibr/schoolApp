<?php

namespace App\Http\Controllers\Backend\Employee;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use DB, Hash, Storage;
use Barryvdh\DomPDF\Facade\PDF;
use App\Models\Designation;
use App\Models\EmployeeSalary;

class MonthlySalaryController extends Controller
{
    public function salaryView() {
        return view('backend.employee.monthly_salary.view_salary');
    }
}
