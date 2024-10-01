<?php

namespace App\Services;

use App\Models\Course;
use App\Models\Instructor;
use Exception;
use Illuminate\Auth\Events\Login;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class CourseService
{
    public function createCourse(array $data)
    {
        try {
            $course = Course::create([
                'title' => $data['title'],
                'description' => isset($data['description']) ? $data['description'] : null,
                'start_date' => $data['start_date'],
            ]);
            $course->instructors()->attach($data['instructor_ids']);
            Log::info("course with instructors created successfully");
            return $course;
        } catch (QueryException $e) {
            Log::error("Database query error while creating course with instructors: " . $e->getMessage());
            throw new Exception('Failed to create course due to a database error');
        } catch (Exception $e) {
            Log::error('An expecrted error while creating course with instructors: ' . $e->getMessage());
            throw new Exception('An unexpected error while creating course with instructors');
        }
    }
    public function getAllCources()
    {
        try {
            $courses = Course::with('instructors')->get();
            Log::info("courses retrieved successfully");
            return $courses;
        } catch (Exception $e) {
            Log::error("Error while retrieving courses with instructors: " . $e->getMessage());
            throw new Exception("Failed retrieving courses with instructors");
        }
    }
    public function updateCourse(array $data, $courseId)
    {
        try {
            $course = Course::findOrFail($courseId);
            $course->update([
                'title' => isset($data['title']) ? $data['title'] : $course->title,
                'description' => isset($data['description']) ? $data['description'] : $course->description,
                'start_date' => isset($data['start_date']) ? $data['start_date'] : $course->start_date,
            ]);
            if (isset($data['instructor_ids'])) {
                $course->instructors()->sync($data['instructor_ids']);
            }
            Log::info("course with instructors updated successfully");
            return $course;
        } catch (ModelNotFoundException $e) {
            Log::error("course with id $courseId not found for update: " . $e->getMessage());
            throw new Exception('Course not Found');
        } catch (QueryException $e) {
            Log::error("Database query error while updating course with instructors: " . $e->getMessage());
            throw new Exception('Failed to update course due to a database error');
        } catch (Exception $e) {
            Log::error('An expecrted error while updating course with instructors: ' . $e->getMessage());
            throw new Exception('An unexpected error while updating course with instructors');
        }
    }
    public function showCourseById($courseId)
    {
        try {
            $course = Course::findOrFail($courseId);
            Log::info("Course id $courseId retrieved successfully");
            return $course;
        } catch (ModelNotFoundException $e) {
            Log::error("Course with id $courseId not found for retrieving: " . $e->getMessage());
            throw new Exception("Course Not Found");
        } catch (QueryException $e) {
            Log::error("Database query error while retrieving course id $courseId : " . $e->getMessage());
            throw new Exception("Database error while retrieving course");
        } catch (Exception $e) {
            Log::error("An unexpected error while retrieving course id $courseId: " . $e->getMessage());
            throw new Exception("An expected error while retrieving course");
        }
    }

    public function deleteCourse($courseId)
    {
        try {
            $course = Course::findOrFail($courseId);
            $course->delete();
            Log::info("Course id $courseId deleted successfully");
        } catch (ModelNotFoundException $e) {
            Log::error("Course with id $courseId not found for deleting: " . $e->getMessage());
            throw new Exception("Course Not Found");
        } catch (Exception $e) {
            Log::error("An unexpected error while deleting course id $courseId: " . $e->getMessage());
            throw new Exception("An expected error while deleting course");
        }
    }

    public function getCourseStudents($courseId)
    {
        try {
            $course = Course::findOrFail($courseId);
            $students = $course->students;
            Log::info("Students for course id $courseId retrieved successfully");
            return $students;
        } catch (ModelNotFoundException $e) {
            Log::error("Course id $courseId not found for retrieving students: " . $e->getMessage());
            throw new Exception("Course Not Found");
        } catch (Exception $e) {
            Log::error("An unexpected error while get students for course id $courseId : " . $e->getMessage());
            throw new Exception("An unexpected error while retrieving students for course");
        }
    }
}
