<?php

namespace App\Http\Resources\Scp;

use Illuminate\Http\Resources\Json\JsonResource;

class LastYearResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'date' => date('d-m-Y', strtotime($this->date)),
            'exam_name' => $this->type,
            'percentage' => $this->percentage.'%',
        ];
    }
}
