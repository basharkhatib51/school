<?php

namespace App\Http\Resources\Tcp;

//{{ use }}

use App\Http\Resources\Student\StudentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResultsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'percentage' => $this->percentage . '%',
            'exam_name' => $this->type,
            'date' => date('d-m-Y', strtotime($this->date)),
            'total_results' => array_sum($this->results->pluck('value')->toArray()),
            'student_count' => count($this->subject_registration->classroom->student_registrations),
            'attended_students' => count($this->results),
            'max_grade' => $this->subject_registration->percentage,
            'results' => ResultsResource::collection($this->students_result)
        ];
    }
}
