<?php

namespace App\Http\Controllers;

use App\Http\Requests\Student\RegisterStudentInCourseRequest;
use App\Http\Requests\Student\StoreStudentRequest;
use App\Http\Requests\Student\UpdateStudentRequest;
use App\Services\StudentService;
use Exception;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    protected $studentService;

    public function __construct(StudentService $studentService)
    {
        $this->studentService = $studentService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $students = $this->studentService->getAllStudent();
            return $this->sendRespons($students, "Students retrieved successfully");
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {

        try {
            $validated = $request->validated();
            $student = $this->studentService->createStudent($validated);
            return $this->sendRespons($student, "Student created successfully");
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {

        try {
            $student = $this->studentService->showStudentById($id);
            return $this->sendRespons($student, "Student retrieved successfully");
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, int $id)
    {

        try {
            $validated = $request->validated();
            $student = $this->studentService->updateStudent($validated, $id);
            return $this->sendRespons($student, "Student updated successfully");
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {

        try {
            $this->studentService->deleteStudent($id);
            return $this->sendRespons(null, "Student deleted successfully");
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    public function registerStudentInCourse(RegisterStudentInCourseRequest $request, $studentId)
    {

        try {
            $validated = $request->validated();
            $this->studentService->registerStudentInCourse($studentId, $validated['course_id']);
            return $this->sendRespons(null, "Student registered in course successfully");
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }
}
