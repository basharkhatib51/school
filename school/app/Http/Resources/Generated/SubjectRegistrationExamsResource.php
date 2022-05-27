<?php

namespace App\Http\Resources\Generated;

//{{ use }}

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectRegistrationExamsResource extends JsonResource
{
    public function toArray($request): array
    {


        $results = $this->student->results->whereNotNull('exam');
        $total = 0;
        foreach ($results as $result) {
            $total += ($result->value * $result->exam->percentage) / 100;
        }
        return [
            "student_name" => $this->student->name,
            "student_id" => $this->student->id,
            "exams" => $results->pluck('value', 'exam.id'),
            "total" => $total,
        ];
    }
}
