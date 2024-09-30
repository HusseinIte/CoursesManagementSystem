<?php

use App\Http\Controllers\CourseController;
use App\Http\Controllers\InstructorController;
use App\Http\Controllers\StudentController;
use App\Http\Resources\InstructorStudentsResource;
use App\Models\Instructor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::apiResource('courses', CourseController::class);
Route::apiResource('instructors', InstructorController::class);
Route::apiResource('students', StudentController::class);
Route::post('students/{id}/courses',[StudentController::class,'registerStudentInCourse']);
