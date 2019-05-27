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
            'id'                 => 'id_student_schoolarship',
            'ra'                 => 'ra_rm_student_schoolarship',
            'establishment'      => 'id_rm_establishment_student_schoolarship',
            'schoolarship'       => 'id_rm_schoolarship_student_schoolarship',
            'schoolarship_order' => 'schoolarship_order_student_schoolarship',
            'value'              => 'value_student_schoolarship',
            'first_installment'  => 'first_installment_student_schoolarship',
            'last_installment'   => 'last_installment_student_schoolarship',
            'period'             => 'id_rm_period_student_schoolarship',
            'contract'           => 'id_rm_contract_student_schoolarship',
            'habilitation'       => 'id_rm_habilitation_establishment_student_schoolarship',
            'modality_major'     => 'id_rm_modality_major_student_schoolarship',
            'course_type'        => 'id_rm_course_type_student_schoolarship',
            'detail'             => 'detail_student_schoolarship',
            'created_at'         => 'created_at_student_schoolarship', 
            'updated_at'         => 'updated_at_student_schoolarship', 
            'deleted_at'         => 'deleted_at_student_schoolarship'        
        ];
    }
}
