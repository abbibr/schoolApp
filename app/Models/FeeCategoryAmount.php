<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\FeeCategorys;
use App\Models\StudentClass;

class FeeCategoryAmount extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'amount' => 'float'
    ];

    public function fee_category(){
        return $this->belongsTo(FeeCategory::class, 'fee_category_id', 'id');
    }

    public function student_class(){
        return $this->belongsTo(StudentClass::class, 'student_class_id', 'id');
    }
}
