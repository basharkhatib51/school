<?php

namespace App\Http\Resources\Scp;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class SubjectRegistrationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'no' => str_pad($this->id, 8, "0", STR_PAD_LEFT),
            'id' => $this->id,
            'subject_name' => $this->subject?->name,
            'classroom_name' => $this->classroom?->name,
            'teacher_name' => $this->teacher->name,
            'class_level_name' => $this->classroom?->class_level?->name,
            'semester_name' => $this->subject?->semester,
            'exams' => ExamResource::collection($this->exams),
            'chat_status' => $this->chat_status,
        ];
    }
}
