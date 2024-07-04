<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\LeavePurpose;

class EmployeeLeave extends Model
{
    use HasFactory;

    // employee = user
    public function employee() {
        return $this->belongsTo(User::class, 'employee_id', 'id');
    }

    public function purpose() {
        return $this->belongsTo(LeavePurpose::class, 'purpose_id', 'id');
    }
}
