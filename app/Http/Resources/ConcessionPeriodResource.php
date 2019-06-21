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
            'id_concession_period'                  => $this->id_concession_period,
            'id_rm_establishment_concession_period' => $this->id_rm_establishment_concession_period,
            'id_rm_modality_concession_period'      => $this->id_rm_modality_concession_period,
            'id_rm_period_concession_period'        => $this->id_rm_period_concession_period,
            'id_rm_period_code_concession_period'   => $this->id_rm_period_code_concession_period,
            'date_start_concession_period'          => $this->date_start_concession_period,
            'date_end_concession_period'            => $this->date_end_concession_period,
            'fk_user'                               => $this->fk_user,
            'created_at_concession_period'          => $this->created_at_concession_period,
            'updated_at_concession_period'          => $this->updated_at_concession_period,
            'deleted_at_concession_period'          => $this->deleted_at_concession_period
        ];
    }
}
