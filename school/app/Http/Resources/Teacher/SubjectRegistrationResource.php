<?php

namespace App\Http\Resources\Teacher;

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
class SubjectRegistrationResource extends JsonResource
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
            "class_level" => $this->subject->class_level->name,
            "subject" => $this->subject->name,
            "classroom" => $this->classroom->name,
            "percentage" => $this->percentage,
            "year" => $this->classroom->year->name,
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
