<?php

namespace App\Services;

use App\Models\Instructor;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class InstructorService
{
    public function createInstructor(array $data)
    {
        try {
            $instructor = Instructor::create([
                'name'       => $data['name'],
                'specialty'  => $data['specialty'],
                'experience' => $data['experience'],
            ]);
            $instructor->courses()->attach($data['course_ids']);
            Log::info("Instructor with courses created successfully");
            return $instructor;
        } catch (QueryException $e) {
            Log::error("Database query error while creating Instructor with courses: " . $e->getMessage());
            throw new Exception('Failed to create instructor due to a database error');
        } catch (Exception $e) {
            Log::error('An expecrted error while creating instructor with courses: ' . $e->getMessage());
            throw new Exception('An unexpected error while creating instructor with courses');
        }
    }
    public function getAllInstructors()
    {
        try {
            $instructor = Instructor::with('courses')->get();
            Log::info("instructors retrieved successfully");
            return $instructor;
        } catch (Exception $e) {
            Log::error("Error while retrieving instructor with courses: " . $e->getMessage());
            throw new Exception("Failed retrieving instructor with courses");
        }
    }
    public function updateInstructor(array $data, $instructorId)
    {
        try {
            $instructor = Instructor::findOrFail($instructorId);
            $instructor->update([
                'name' => isset($data['name']) ? $data['name'] : $instructor->name,
                'specialty' => isset($data['specialty']) ? $data['specialty'] : $instructor->specialty,
                'experience' => isset($data['experience']) ? $data['experience'] : $instructor->experience,
            ]);
            if (isset($data['course_ids'])) {
                $instructor->courses()->sync($data['course_ids']);
            }
            Log::info("instructors with courses updated successfully");
            return $instructor;
        } catch (ModelNotFoundException $e) {
            Log::error("Instructor with id $instructorId not found for update: " . $e->getMessage());
            throw new Exception('Instructor not Found');
        } catch (QueryException $e) {
            Log::error("Database query error while updating instructor with courses: " . $e->getMessage());
            throw new Exception('Failed to update instructor due to a database error');
        } catch (Exception $e) {
            Log::error('An expecrted error while updating instructor with courses: ' . $e->getMessage());
            throw new Exception('An unexpected error while updating instructor with courses');
        }
    }
    public function showInstructorById($instructorId)
    {
        try {
            $instructor = Instructor::findOrFail($instructorId);
            Log::info("instructor id $instructorId retrieved successfully");
            return $instructor;
        } catch (ModelNotFoundException $e) {
            Log::error("Instructor with id $instructorId not found for retrieving: " . $e->getMessage());
            throw new Exception("Instructor Not Found");
        } catch (QueryException $e) {
            Log::error("Database query error while retrieving instructor id $instructorId : " . $e->getMessage());
            throw new Exception("Database error while retrieving instructor");
        } catch (Exception $e) {
            Log::error("An unexpected error while retrieving course id $instructorId: " . $e->getMessage());
            throw new Exception("An expected error while retrieving insrtuctor");
        }
    }

    public function deleteInstructor($instructorId)
    {
        try {
            $instructor = Instructor::findOrFail($instructorId);
            $instructor->delete();
            Log::info("Instructor id $instructorId deleted successfully");
        } catch (ModelNotFoundException $e) {
            Log::error("Instructor with id $instructorId not found for deleting: " . $e->getMessage());
            throw new Exception("Instructor Not Found");
        } catch (Exception $e) {
            Log::error("An unexpected error while deleting instructor id $instructorId: " . $e->getMessage());
            throw new Exception("An expected error while deleting instructor");
        }
    }

    public function getInstructorCourses($instructorId)
    {
        try {
            $instructor = Instructor::findOrFail($instructorId);
            $courses = $instructor->courses;
            Log::info("Courses for Instructor id $instructorId retrieved successfully");
            return $courses;
        } catch (ModelNotFoundException $e) {
            Log::error("Instructor id $instructorId not found for retrieving courses: " . $e->getMessage());
            throw new Exception("Instructor Not Found");
        } catch (Exception $e) {
            Log::error("An unexpected error while retrieving courses for instructor id $instructorId : " . $e->getMessage());
            throw new Exception("An unexpected error while retrieving courses for instructor");
        }
    }

    public function getInstructorStudents($instructorId)
    {
        try {
            $instructor = Instructor::findOrFail($instructorId);
            $students = $instructor->load('studentsInMyCourses') ;
            Log::info("Students for Instructor id $instructorId retrieved successfully");
            return $students;
        } catch (ModelNotFoundException $e) {
            Log::error("Instructor id $instructorId not found for retrieving students: " . $e->getMessage());
            throw new Exception("Instructor Not Found");
        } catch (Exception $e) {
            Log::error("An unexpected error while retrieving students for instructor id $instructorId : " . $e->getMessage());
            throw new Exception("An unexpected error while retrieving students for instructor");
        }
    }
}
