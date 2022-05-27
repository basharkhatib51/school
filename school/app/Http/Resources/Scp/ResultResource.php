<?php

namespace App\Http\Resources\Scp;

use Illuminate\Http\Resources\Json\JsonResource;

class ResultResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'exam' => $this->exam->type,
            'percentage' => $this->exam->percentage .'%',
            'from' =>$this->exam->subject_registration->percentage,
            'subject' => $this->exam->subject_registration->subject->name,
            'semester'=>$this->exam->subject_registration->subject->semester,
            'result'=>$this->value,
        ];
    }
}
