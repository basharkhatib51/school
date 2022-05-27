<?php

namespace App\Http\Resources\Scp;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class ProgramResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'no' => str_pad($this->id, 8, "0", STR_PAD_LEFT),
            'id' => $this->id,
            'finish_at' => Carbon::createFromFormat('H:i:s',$this->finish_at)->format('h:i a'),
            'start_at' => Carbon::createFromFormat('H:i:s',$this->start_at)->format('h:i a'),
            'day' => $this->day,
            'name' => $this->start_at,
            'subject_registration' => $this->subject_registration?->id,
            'subject_name' => $this->subject_registration->subject->name,
            'teacher_name' => $this->subject_registration->teacher->name,
            'classroom_name' => $this->subject_registration->classroom->name,
            'class_level_name' => $this->subject_registration->classroom->class_level->name,
//            'subject_registration_data' => $this->subject_registration,
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
