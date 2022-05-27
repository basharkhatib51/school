<?php

namespace App\Http\Resources\Generated;

//{{ use }}

use Illuminate\Http\Resources\Json\JsonResource;

class ClassroomResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'no' => str_pad($this->id, 8, "0", STR_PAD_LEFT),
            'id' => $this->id,
            'name' => $this->name,
            'subject_registrations_count' => $this->subject_registrations->count(),
            'class_level' => $this->class_level->id,
            'class_level_name' => $this->class_level->name,
            'notifications_count' => $this->notifications->count(),
            'year' => new YearResource($this->year),
            'students_count' => $this->student_registrations->count(),
            'subjects_count' => $this->subject_registrations->count(),
            'student_registrations' => StudentRegistrationResource::collection($this->student_registrations),
            'subject_registrations' => SubjectRegistrationResource::collection($this->subject_registrations),
            'classroom_programs' => ProgramResource::collection($this->programs()->orderBy('start_at', 'asc')->get())->groupBy('day'),
            "created_by" => $this->created_by_user?->name,
            "created_by_id" => $this->created_by_user?->id,
            "updated_by" => $this->updated_by_user?->name,
            "updated_by_id" => $this->updated_by_user?->id,
            $this->mergeWhen($this->created_at, [
                "created_at" => $this->created_at?->format("Y-m-d (h:i)A"),
                "created_from" => $this->created_at?->diffForHumans(),
            ]),
            $this->mergeWhen($this->updated_at, [
                "updated_at" => $this->updated_at?->format("Y-m-d (h:i)A"),
                "updated_from" => $this->updated_at?->diffForHumans(),
            ]),
            $this->mergeWhen($this->deleted_at, [
                "deleted_at" => $this->deleted_at?->format("Y-m-d (h:i)A"),
                "deleted_from" => $this->deleted_at?->diffForHumans(),
            ]),
        ];
    }
}
