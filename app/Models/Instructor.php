<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instructor extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'specialty',
        'experience'
    ];
    protected $hidden = ['pivot'];

    public function courses()
    {
        return $this->belongsToMany(Course::class, 'course_instructor');
    }
    public function studentsInMyCourses()
    {
        return $this->hasManyThrough(
            CourseStudent::class,
            CourseInstructor::class,
            'instructor_id',
            'course_id',
            'id',
            'course_id'
        );
    }
}
