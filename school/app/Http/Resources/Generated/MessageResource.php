<?php

namespace App\Http\Resources\Generated;

//{{ use }}

use Illuminate\Http\Resources\Json\JsonResource;
class MessageResource extends JsonResource
{
    public function toArray($request): array
    {
        return[
        'no'=>str_pad($this->id, 8, "0", STR_PAD_LEFT),
        'id'=>$this->id,
        'content' => $this->content,
'sender_type' => $this->sender_type,
'reciver_type' => $this->reciver_type,
'image' => $this->upload_image?->id,
'image_data' => $this->upload_image,
'name'=>$this->content,
        'student'=>$this->student?->id,
 'student_data'=> $this->student,
'teacher'=>$this->teacher?->id,
 'teacher_data'=> $this->teacher,
'subject_registration'=>$this->subject_registration?->id,
 'subject_registration_data'=> $this->subject_registration,


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
