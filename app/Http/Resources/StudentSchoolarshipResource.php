<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentSchoolarshipResource extends JsonResource
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
            'ra_rm_student_schoolarship'                            => $this->ra_rm_student_schoolarship,
            'id_rm_schoolarship_student_schoolarship'               => $this->id_rm_schoolarship_student_schoolarship,
            'id_rm_period_student_schoolarship'                     => $this->id_rm_period_student_schoolarship,
            'id_rm_contract_student_schoolarship'                   => $this->id_rm_contract_student_schoolarship,
            'id_rm_habilitation_establishment_student_schoolarship' => $this->id_rm_habilitation_establishment_student_schoolarship,
            'id_rm_establishment_student_schoolarship'              => $this->id_rm_establishment_student_schoolarship,
            'id_rm_modality_major_student_schoolarship'             => $this->id_rm_modality_major_student_schoolarship,
            'id_rm_course_type_student_schoolarship'                => $this->id_rm_course_type_student_schoolarship,
            'schoolarship_order_student_schoolarship'               => $this->schoolarship_order_student_schoolarship,
            'value_student_schoolarship'                            => $this->value_student_schoolarship,
            'first_installment_student_schoolarship'                => $this->first_installment_student_schoolarship,
            'last_installment_student_schoolarship'                 => $this->last_installment_student_schoolarship,
            'detail_student_schoolarship'                          => $this->detail_student_schoolarship
        ];
    }
}
