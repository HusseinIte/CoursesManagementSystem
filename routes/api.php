<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentController;
use App\Http\Resources\InstructorStudentsResource;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('courses', CourseController::class);
Route::get('courses/{id}/students', [CourseController::class, 'getCourseStudents']);

Route::apiResource('instructors', InstructorController::class);
Route::get('instructors/{id}/courses', [InstructorController::class, 'getInstructorCourses']);
Route::get('instructors/{id}/students', [InstructorController::class, 'getInstructorStudents']);


Route::apiResource('students', StudentController::class);
Route::post('students/{id}/courses', [StudentController::class, 'registerStudentInCourse']);
