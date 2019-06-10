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
            'id'                   => $this->id_student_schoolarship,
            'ra'                   => $this->ra_rm_student_schoolarship,
            'establishment'        => $this->id_rm_establishment_student_schoolarship,
            'schoolarship'         => $this->id_rm_schoolarship_student_schoolarship,
            'schoolarship_order'   => $this->schoolarship_order_student_schoolarship,
            'student_schoolarship' => $this->id_rm_student_schoolarship,
            'value'                => $this->value_student_schoolarship,
            'first_installment'    => $this->first_installment_student_schoolarship,
            'last_installment'     => $this->last_installment_student_schoolarship,
            'service'              => $this->id_rm_service_student_schoolarship,
            'period'               => $this->id_rm_period_student_schoolarship,
            'period_code'          => $this->id_rm_period_code_student_schoolarship,
            'contract'             => $this->id_rm_contract_student_schoolarship,
            'habilitation'         => $this->id_rm_habilitation_establishment_student_schoolarship,
            'modality_major'       => $this->id_rm_modality_major_student_schoolarship,
            'course_type'          => $this->id_rm_course_type_student_schoolarship,
            'detail'               => $this->detail_student_schoolarship,
            'active'               => $this->active_student_schoolarship,
            'send_rm'              => $this->send_rm_student_schoolarship,
            'created_at'           => $this->created_at_student_schoolarship, 
            'updated_at'           => $this->updated_at_student_schoolarship, 
            'deleted_at'           => $this->deleted_at_student_schoolarship        
        ];
    }
}
