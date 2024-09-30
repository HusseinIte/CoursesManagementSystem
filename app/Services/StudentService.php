<?php

namespace App\Services;

use App\Models\Student;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class StudentService
{
    public function getAllStudent()
    {
        try {
            $students = Student::all();
            Log::info("Students retrieved successfully");
            return $students;
        } catch (QueryException $e) {
            Log::error("Database query error while retrieving students: " . $e->getMessage());
            throw new Exception("Database query error while retrieving students");
        } catch (Exception $e) {
            Log::error("An expected error while retrieving students: " . $e->getMessage());
            throw new Exception("An expected error while retrieving students");
        }
    }
    public function createStudent(array $data)
    {
        try {
            $student = Student::create([
                'name' => $data['name'],
                'email' => $data['email']
            ]);
            Log::info("Student created successfully");
            return $student;
        } catch (QueryException $e) {
            Log::error("Database query error while creating student: " . $e->getMessage());
            throw new Exception("Database query error while creating student");
        } catch (Exception $e) {
            Log::error("An unexpected error while creating student" . $e->getMessage());
            throw new Exception("An unexpected error while creating student");
        }
    }
    public function updateStudent(array $data, $studentId)
    {
        try {
            $student = Student::findOrFail($studentId);
            $student->update([
                'name'  => isset($data['name'])  ? $data['name']  : $student->name,
                'email' => isset($data['email']) ? $data['email'] : $student->email,
            ]);
            Log::info("Student id $studentId updated successfully");
            return $student;
        } catch (ModelNotFoundException $e) {
            Log::error("Student id $studentId not found for updating: " . $e->getMessage());
            throw new Exception("Student Not Found");
        } catch (QueryException $e) {
            Log::error("Database error while updating student id $studentId: " . $e->getMessage());
            throw new Exception("Database error while updating student");
        } catch (Exception $e) {
            Log::error("An expected error while updating student id $studentId : " . $e->getMessage());
            throw new Exception("An expected error while updating student");
        }
    }
    public function showStudentById($studentId)
    {
        try {
            $student = Student::findOrFail($studentId);
            Log::info("Student id $studentId retrieved successfully");
            return $student;
        } catch (ModelNotFoundException $e) {
            Log::error("Student id $studentId not found for retrieving: " . $e->getMessage());
            throw new Exception("Student Not Found");
        } catch (QueryException $e) {
            Log::error("Database error while retrieving student id $studentId: " . $e->getMessage());
            throw new Exception("Database error while retrieving student");
        } catch (Exception $e) {
            Log::error("An expected error while retrieving student id $studentId : " . $e->getMessage());
            throw new Exception("An expected error while retrieving student");
        }
    }
    public function deleteStudent($studentId)
    {
        try {
            $student = Student::findOrFail($studentId);
            $student->delete();
            Log::info("Student id $studentId deleted successfully");
        } catch (ModelNotFoundException $e) {
            Log::error("Student id $studentId not found for deleting: " . $e->getMessage());
            throw new Exception("Student Not Found");
        } catch (QueryException $e) {
            Log::error("Database error while deleting student id $studentId: " . $e->getMessage());
            throw new Exception("Database error while deleting student");
        } catch (Exception $e) {
            Log::error("An expected error while deleting student id $studentId : " . $e->getMessage());
            throw new Exception("An expected error while deleting student");
        }
    }
    public function registerStudentInCourse($studentId, $courseId)
    {
        try {
            $student = Student::findOrFail($studentId);
            $student->courses()->attach($courseId);
            Log::info("Student id $studentId registered in course id $courseId successfully");
        } catch (ModelNotFoundException $e) {
            Log::error("Student id $studentId not found for registering in course: " . $e->getMessage());
            throw new Exception("Student Not Found");
        } catch (Exception $e) {
            Log::error("An expected error while resgistering in course student id $studentId : " . $e->getMessage());
            throw new Exception("An expected error while registering in coorse student");
        }
    }
}
