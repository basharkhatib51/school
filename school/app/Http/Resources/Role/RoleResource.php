<?php

namespace App\Http\Resources\Role;

use App\Http\Resources\Permission\PermissionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @method getAllPermissions()
 * @property mixed name
 * @property mixed id
 * @property mixed created_by_user
 * @property mixed updated_by_user
 * @property mixed created_at
 * @property mixed updated_at
 */
class RoleResource extends JsonResource
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
            'no'=>str_pad($this->id, 8, "0", STR_PAD_LEFT),
            "id" => $this->id,
            "name" => $this->name,
            "permissions" => PermissionResource::collection($this->getAllPermissions()),
            "created_by" => $this->created_by_user?->name,
            "updated_by" => $this->updated_by_user?->name,
            $this->mergeWhen($this->created_at, [
                "created_at" => $this->created_at?->format("Y-m-d (h:i)A"),
                "created_from" => $this->created_at?->diffForHumans(),
            ]),
            $this->mergeWhen($this->updated_at, [
                "updated_at" => $this->updated_at?->format("Y-m-d (h:i)A"),
                "updated_from" => $this->updated_at?->diffForHumans(),
            ]),
        ];
    }
}
