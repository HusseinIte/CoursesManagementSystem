<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseStudent extends Model
{
    use HasFactory;
    protected $table = "course_student";

    public function student()
    {
        return $this->belongsTo(Student::class);
    }
}
