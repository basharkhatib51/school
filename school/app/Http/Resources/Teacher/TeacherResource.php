<?php

namespace App\Http\Resources\Teacher;

use App\Http\Resources\Generated\ProgramResource;
use App\Http\Resources\Permission\PermissionResource;
use App\Http\Resources\Role\RoleResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @property mixed id
 * @property mixed first_name
 * @property mixed last_name
 * @property mixed email
 * @property mixed email_verified_at
 * @property mixed status
 * @property mixed roles
 * @property mixed blocked_reason
 * @property mixed phone
 * @property mixed languages
 * @property mixed uploaded_avatar
 * @property mixed avatar
 * @property mixed created_by_user
 * @property mixed updated_by_user
 * @property mixed mergeWhen
 * @property mixed created_at
 * @property mixed updated_at
 * @property mixed deleted_at
 * @method getAllPermissions()
 */
class TeacherResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'no' => str_pad($this->id, 8, "0", STR_PAD_LEFT),
            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "name" => $this->name,
            "user_type" => $this->user_type,
            "email" => $this->email,
            "model_number" => $this->model_number,
            "programs" => ProgramResource::collection($this->current_programs()->orderBy('start_at', 'asc')->get())->groupBy('day'),
            "email_verified_at" => $this->email_verified_at,
            "subject_registrations" => SubjectRegistrationResource::collection($this->subject_registrations),
            "status" => $this->status,
            "permissions" =>[],
            "role" => [
                "name" => "teacher",
                "permissions" => []
            ],
            $this->mergeWhen($this->status == 'blocked', [
                "blocked_reason" => $this->blocked_reason,
            ]),
            "phone" => $this->phone,
            "avatar" => $this->uploaded_avatar?->url ?? $this->avatar,
            "avatar_id" => $this->uploaded_avatar?->id,
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
