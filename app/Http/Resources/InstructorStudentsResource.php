<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class InstructorStudentsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'experience' => $this->experience,
            'specialty' => $this->specialty,
            'students' => $this->studentsInMyCourses->map(function ($courseStudent) {
                return [
                    'id' => $courseStudent->student->id,
                    'name' => $courseStudent->student->name,
                    'email' => $courseStudent->student->email,
                    'created_at' => $courseStudent->student->created_at,
                    'updated_at' => $courseStudent->student->updated_at,
                ];
            }),
        ];
    }
}
