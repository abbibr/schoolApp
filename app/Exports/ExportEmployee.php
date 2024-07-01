<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Models\User;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class ExportEmployee implements FromView, ShouldAutoSize
{
    public function view(): View
    {
        return view('backend.employee.employee_reg.employee_lists', [
            'employees' => User::where('usertype', 'employee')->get()
        ]);
    }
}
