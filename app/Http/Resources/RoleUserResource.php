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
            'role'       => $this->fk_role,
            'user'       => $this->fk_user,
            'created_at' => $this->created_at_role_user, 
            'updated_at' => $this->updated_at_role_user, 
            'deleted_at' => $this->deleted_at_role_user
        ];
    }
}
