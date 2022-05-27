<?php

namespace App\Http\Resources\Tcp;

//{{ use }}

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class TeacherProgramResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'no' => str_pad($this->id, 8, "0", STR_PAD_LEFT),
            'id' => $this->id,
            'finish_at' => Carbon::createFromFormat('H:i:s',$this->finish_at)->format('h:i a'),
            'start_at' => Carbon::createFromFormat('H:i:s',$this->start_at)->format('h:i a'),
            'day' => $this->day,
            'subject_name' => $this->subject_registration->subject->name,
            'classroom_name' => $this->subject_registration->classroom->name,
            'class_level_name' => $this->subject_registration->classroom->class_level->name,
        ];
    }
}
