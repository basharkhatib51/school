<?php

namespace App\Http\Resources\Generated;

//{{ use }}

use App\Http\Resources\Student\StudentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ExamResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'key' => strval($this->id),
            'label' => $this->type . " ($this->percentage %)",
            'percentage' => $this->percentage .'%',
            'exam_name'=>$this->type,
            'date' => date('d-m-Y', strtotime($this->date)),
            'total_results' =>array_sum($this->results->pluck('value')->toArray()),
            'students_taken_Exam' => count($this->results),
            'student_count' => count($this->subject_registration->classroom->student_registrations),
            'attended_students' => count($this->results),
        ];
    }
}
