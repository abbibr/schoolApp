<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\StudentClass;
use App\Models\StudentSubject;

class AssignSubject extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function student_class(){
        return $this->belongsTo(StudentClass::class, 'class_id', 'id');
    }

    public function school_subject(){
        return $this->belongsTo(StudentSubject::class, 'subject_id', 'id');
    }
}
