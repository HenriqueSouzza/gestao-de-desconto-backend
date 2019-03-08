<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionRoleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'         => $this->id_permission_role,
            'permission' => new PermissionResource($this->permission),
            'role'       => new RoleResource($this->role),
            'created_at' => $this->created_at_permission_role, 
            'updated_at' => $this->updated_at_permission_role, 
            'deleted_at' => $this->deleted_at_permission_role
        ];
    }
}
