<?php

namespace App\Http\Resources\Tcp;

//{{ use }}

use App\Http\Resources\Student\StudentResource;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Auth;

class MessagesResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'content' => $this->upload_id?$this->file:$this->content,
            'type' => $this->upload_id ? $this->file->type : 'text',
            "created_at" => $this->created_at?->format("Y-m-d (h:i)A"),
            "created_from" => $this->created_at?->diffForHumans(),
//            'sender' => $this->sender,
            'sender_name' => $this->sender?->name,
            'sender_id' => $this->sender?->id,
            'status' => 'done',
        ];
    }
}
