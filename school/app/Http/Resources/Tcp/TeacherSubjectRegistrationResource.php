<?php

namespace App\Http\Resources\Tcp;

//{{ use }}

use Illuminate\Http\Resources\Json\JsonResource;

class TeacherSubjectRegistrationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'no' => str_pad($this->id, 8, "0", STR_PAD_LEFT),
            'id' => $this->id,
            'chat_status' => $this->chat_status,
            'subject_name' => $this->subject?->name,
            'semester_name' => $this->subject?->semester,
            'exam_data' => TeacherExamResource::collection($this->exams),
            'students' => TcpStudentResource::collection($this->subject_registration_exams),
            'class_level_name' => $this->classroom?->class_level?->name,
            'classroom_name' => $this->classroom?->name,
            'subject' => $this->subject?->id,
            'classroom' => $this->classroom?->id,
            'subject_data' => $this->subject,
        ];
    }
}
