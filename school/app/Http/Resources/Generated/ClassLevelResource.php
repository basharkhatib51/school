<?php

namespace App\Http\Resources\Generated;

//{{ use }}

use App\Models\Generated\Year;
use Illuminate\Http\Resources\Json\JsonResource;

class ClassLevelResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'no' => str_pad($this->id, 8, "0", STR_PAD_LEFT),
            'id' => $this->id,
            'name' => $this->name,
            'class_rooms' => ClassroomResource::collection($this->classrooms),
            'classrooms_count' => $this->classrooms->where('year_id',Year::latest('id')->first()->id)->count(),
            'current_classrooms' => $this->classrooms->where('year_id',Year::latest('id')->first()->id),
            'fees_value' => $this->fees->where('year_id',Year::latest('id')->first()->id)->first()?->value,
            'subjects' => SubjectResource::collection($this->subjects),
            'subjects_count' => $this->subjects->count(),
            'notifications_count' => $this->notifications->count(),
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
