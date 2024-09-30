<?php

namespace App\Http\Controllers;

use App\Http\Requests\Instructor\StoreInstructorRequest;
use App\Http\Requests\Instructor\UpdateInstructorRequest;
use App\Models\Instructor;
use App\Services\InstructorService;
use Exception;
use Illuminate\Http\Request;

class InstructorController extends Controller
{
    protected $instructorService;
    public function __construct(InstructorService $instructorService)
    {
        $this->instructorService = $instructorService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $instructors = $this->instructorService->getAllInstructors();
            return $this->sendRespons($instructors, 'instructors with Courses retrieved successfully');
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreInstructorRequest $request)
    {
        try {
            $validated = $request->validated();
            $course = $this->instructorService->createInstructor($validated);
            return $this->sendRespons($course, 'Instructor created successfully');
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
            $instructor = $this->instructorService->showInstructorById($id);
            return $this->sendRespons($instructor, "Instructor retrieved successfully");
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateInstructorRequest $request, int $id)
    {
        try {
            $validated = $request->validated();
            $instructor = $this->instructorService->updateInstructor($validated, $id);
            return $this->sendRespons($instructor, 'Instructor updated successfully');
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
            $this->instructorService->deleteInstructor($id);
            return $this->sendRespons(null, "Insrtuctor deleted successfully");
        } catch (Exception $e) {
            return $this->sendError(null, $e->getMessage());
        }
    }
}
