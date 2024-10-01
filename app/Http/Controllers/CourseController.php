<?php

namespace App\Http\Controllers;

use App\Http\Requests\Course\StoreCourseRequest;
use App\Http\Requests\Course\UpdateCourseRequest;
use App\Services\CourseService;
use Exception;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    protected $courseService;
    public function __construct(CourseService $courseService)
    {
        $this->courseService = $courseService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $courses = $this->courseService->getAllCources();
            return $this->sendRespons($courses, 'Courses with instructors retrieved successfully');
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCourseRequest $request)
    {
        try {
            $validated = $request->validated();
            $course = $this->courseService->createCourse($validated);
            return $this->sendRespons($course, 'course created successfully');
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(int $id)
    {
        try {
            $course = $this->courseService->showCourseById($id);
            return $this->sendRespons($course, "course retrieved successfullt");
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCourseRequest $request, int $id)
    {
        try {
            $validated = $request->validated();
            $course = $this->courseService->updateCourse($validated, $id);
            return $this->sendRespons($course, 'Course updated successfully');
        } catch (\Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $id)
    {
        try {
            $this->courseService->deleteCourse($id);
            return $this->sendRespons(null, "course deleted successfullt");
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }
    public function getCourseStudents($courseId)
    {
        try {
            $students = $this->courseService->getCourseStudents($courseId);
            return $this->sendRespons($students, "Students for course retrieved successfully");
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }
}
