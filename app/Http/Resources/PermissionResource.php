<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class PermissionResource extends JsonResource
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
            'id'         => $this->id_permission,
            'name'       => $this->name_permission,
            'label'      => $this->label_permission,
            'action'     => $this->action_permission,
            'created_at' => $this->created_at_permission,
            'updated_at' => $this->updated_at_permission,
            'deleted_at' => $this->deleted_at_permission,
        ];
    }
}
