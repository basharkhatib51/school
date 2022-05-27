<?php

namespace App\Http\Resources\Generated;

//{{ use }}

use App\Models\Generated\Year;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentRegistrationResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'no' => str_pad($this->id, 8, "0", STR_PAD_LEFT),
            'id' => $this->id,
            'name' => $this->id,
            'student' => $this->student?->id,
            'student_no' => str_pad($this->student?->id, 8, "0", STR_PAD_LEFT),
            'student_data' => $this->student,
            'classroom' => $this->classroom,
            'subject' => SubjectRegistrationResource::collection($this->subject_registrations),
            'class_level' => $this->classroom->class_level,
            'fee' => $this->fee(),
            'payments' => $this->total_payments(),
            'debt' => $this->debt(),
            'payments_data' => $this->payments,
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
