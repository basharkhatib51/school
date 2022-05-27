<?php

namespace App\Http\Resources\Generated;

//{{ use }}

use Illuminate\Http\Resources\Json\JsonResource;

class SubjectRegistrationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'no' => str_pad($this->id, 8, "0", STR_PAD_LEFT),
            'id' => $this->id,
            'chat_status' => $this->chat_status,
            'name' => $this->chat_status,
            'subject' => $this->subject?->id,
            'subject_name' => $this->subject?->name,
            'semester_name' => $this->subject?->semester,
            'programs' => ProgramResource::collection($this->programs),
            'class_level_name' =>$this->classroom?->class_level?->name,
            'classroom' => $this->classroom?->id,
            'subject_data' => $this->subject,
            'classroom_name'=> $this->classroom?->name,
            'teacher' => $this->teacher?->id,
            'teacher_data' => $this->teacher,
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
