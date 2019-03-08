<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RoleResource extends JsonResource
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
            'id'         => $this->id_role,
            'name'       => $this->name_role,
            'label'      => $this->label_role,
            'created_at' => $this->created_at_role,
            'updated_at' => $this->updated_at_role,
            'deleted_at' => $this->deleted_at_role,
        ];
    }
}
