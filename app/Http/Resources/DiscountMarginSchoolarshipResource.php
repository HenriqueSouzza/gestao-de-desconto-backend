<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class DiscountMarginSchoolarshipResource extends JsonResource
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
            'id_discount_margin_schoolarship'                          => $this->id_discount_margin_schoolarship,
            'id_rm_schoolarship_discount_margin_schoolarship'          => $this->id_rm_schoolarship_discount_margin_schoolarship,
            'id_rm_schoolarship_name_discount_margin_schoolarship'     => $this->id_rm_schoolarship_name_discount_margin_schoolarship,
            'id_rm_establishment_discount_margin_schoolarship'         => $this->id_rm_establishment_discount_margin_schoolarship,
            'id_rm_course_type_discount_margin_schoolarship'           => $this->id_rm_course_type_discount_margin_schoolarship,
            'id_rm_modality_discount_margin_schoolarship'              => $this->id_rm_modality_discount_margin_schoolarship,
            'id_rm_major_discount_margin_schoolarship'                 => $this->id_rm_major_discount_margin_schoolarship,
            'id_rm_period_discount_margin_schoolarship'                => $this->id_rm_period_discount_margin_schoolarship,
            'id_rm_period_code_discount_margin_schoolarship'           => $this->id_rm_period_code_discount_margin_schoolarship, 
            'max_value_discount_margin_schoolarship'                   => $this->max_value_discount_margin_schoolarship, 
            'is_exact_value_discount_margin_schoolarship'              => $this->is_exact_value_discount_margin_schoolarship,
            'first_installment_discount_margin_schoolarship'           => $this->first_installment_discount_margin_schoolarship,
            'last_installment_discount_margin_schoolarship'            => $this->last_installment_discount_margin_schoolarship,
            'fk_user'                                                  => $this->fk_user,
            'created_at_discount_margin_schoolarship'                  => $this->created_at_discount_margin_schoolarship,
            'updated_at_discount_margin_schoolarship'                  => $this->updated_at_discount_margin_schoolarship,
            'deleted_at_discount_margin_schoolarship'                  => $this->deleted_at_discount_margin_schoolarship
        ];
    }
}
