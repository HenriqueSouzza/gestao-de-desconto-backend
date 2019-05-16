<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class SchoolarshipWorkflowResource extends JsonResource
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
            'fk_user'                      => $this->fk_user,
            'fk_student_schoolarship'      => $this->fk_student_schoolarship,
            'fk_action'                    => $this->fk_action,
            'detail_schoolarship_workflow' => $this->detail_schoolarship_workflow,
            'user'                         => new UserResource($this->user)

        ];
    }
}
