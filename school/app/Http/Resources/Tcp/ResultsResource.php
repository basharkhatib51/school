<?php

namespace App\Http\Resources\Tcp;

//{{ use }}

use App\Http\Resources\Student\StudentResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ResultsResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'student_id' => $this->id,
            'student_name' => $this->name,
            'result_value' => $this->results?->first()?->value??'No result yet'
        ];
    }
}
