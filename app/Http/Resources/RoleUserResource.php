<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleUserResource extends JsonResource
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
            
            'id'         => $this->id_role_user,
            'role'       => new RoleResource($this->roles),
            'user'       => new UserResource($this->user),
            'created_at' => $this->created_at_role_user, 
            'updated_at' => $this->updated_at_role_user, 
            'deleted_at' => $this->deleted_at_role_user
        ];
    }
}
