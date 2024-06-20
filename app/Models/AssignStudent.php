<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\StudentClass;
use App\Models\StudentYear;
use App\Models\DiscountStudent;
use App\Models\StudentShift;
use App\Models\StudentGroup;

class AssignStudent extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student() { // student = users table
        return $this->belongsTo(User::class, 'student_id', 'id');
    }

    public function year() {
        return $this->belongsTo(StudentYear::class, 'year_id', 'id');
    }

    public function class() {
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function group() {
        return $this->belongsTo(StudentGroup::class, 'group_id', 'id');
    }

    public function shift() {
        return $this->belongsTo(StudentShift::class, 'shift_id', 'id');
    }

    public function discount() {
        return $this->hasMany(DiscountStudent::class, 'assign_student_id', 'id');
    }
}
