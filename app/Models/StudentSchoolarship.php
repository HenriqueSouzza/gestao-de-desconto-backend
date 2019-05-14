<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class StudentSchoolarship extends Model
{
    use SoftDeletes;

    /**
     * <b>table</b> Informa qual é a tabela que o modelo irá utilizar
    */
    public $table = "student_schoolarships";

     /**
     * <b>fillable</b> Informa quais colunas é permitido a inserção de dados (MassAssignment)
     *  
     */
    protected $fillable = [
        'ra_rm_student_schoolarship',
        'id_rm_schoolarship_student_schoolarship',
        'id_rm_period_student_schoolarship',
        'id_rm_contract_student_schoolarship',
        'id_rm_habilitation_establishment_student_schoolarship',
        'id_rm_establishment_student_schoolarship',
        'id_rm_modality_major_student_schoolarship',
        'id_rm_course_type_student_schoolarship',
        'schoolarship_order_student_schoolarship',
        'value_student_schoolarship',
        'first_installment_student_schoolarship',
        'last_installment_student_schoolarship',
        'detail_student_schoolarship'
    ];

    /**
     * <b>CREATED_AT</b> Renomeia o campo padrão created_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */

    const CREATED_AT = 'created_at_student_schoolarship';
    /**
     * <b>UPDATED_AT</b>  Renomeia o campo padrão updated_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */

    const UPDATED_AT = 'updated_at_student_schoolarship';
    
    /**
     * <b>DELETED_AT</b> Renomeia o campo padrão deleted_at criado por padrão quando utilizamos a Trait SoftDeletes na model
     * OBS: Essa trait habilita a exclusão logica de registros nativa do Laravel
     */
    const DELETED_AT = 'deleted_at_student_schoolarship';

   

    /**
     * <b>primaryKey</b> Informa qual a é a chave primaria da tabela
     */
    protected $primaryKey = "id_student_schoolarship";

    /**
     * <b>dates</b> Serve para tratar todos os campos de data para serem também um objeto do tipo Carbon(biblioteca de datas)
     */

    protected $dates = ['created_at_student_schoolarship', 'updated_at_student_schoolarship', 'deleted_at_student_schoolarship'];

    /**
     * <b>rules</b> Atributo responsável em definir regras de validação dos dados submetidos pelo formulário
     * OBS: A validação bail é responsável em parar a validação caso um das que tenha sido especificada falhe
    */

    public $rules = [
        'ra_rm_student_schoolarship' => 'required|max:50',
        'id_rm_schoolarship_student_schoolarship' => 'required|max:50',
        'id_rm_period_student_schoolarship' => 'required|max:50',
        'id_rm_contract_student_schoolarship' => 'required|max:50',
        'id_rm_habilitation_establishment_student_schoolarship' => 'required|max:50',
        'id_rm_establishment_student_schoolarship' => 'required|max:50',
        'id_rm_modality_major_student_schoolarship' => 'required|max:50',
        'id_rm_course_type_student_schoolarship' => 'required|max:50',
        'schoolarship_order_student_schoolarship' => 'required|max:50',
        'value_student_schoolarship' => 'required|max:50',
        'first_installment_student_schoolarship' => 'required|max:50',
        'last_installment_student_schoolarship' => 'required|max:50'
        // 'detail_student_schoolarship' => 'required|max:250'        
        
    ];

    /**
     * <b>messages</b>  Atributo responsável em definir mensagem de validação de acordo com as regras especificadas no atributo $rules
    */
    public $messages = [
       
    ];

    /**
     * <b>hidden</b> Atributo responsável em esconder colunas que não deverão ser retornadas em uma requisição
    */
    protected $hidden  = [
        
    ];
    /**
     *<b>collection</b> Atributo responsável em informar o namespace e o arquivo do resource
     * O mesmo é utilizado em forma de facade.
     * OBS: Responsável em retornar uma coleção com os alias(apelido) atribuidos para cada coluna. 
     * Mais informações em https://laravel.com/docs/5.5/eloquent-resources
    */
    public $collection = "\App\Http\Resources\StudentSchoolarShipResource::collection";

    /**
     * <b>resource</b>
     */
    public $resource = "\App\Http\Resources\StudentSchoolarShipResource";

    /**
     * <b>map</b> Atributo responsável em atribuir um alias(Apelido), para a colunas do banco de dados
     * OBS: este atributo é utilizado no Metodo store e update da ApiControllerTrait
     */
    public $map = [
        'ra_rm_student_schoolarship' => 'ra_rm_student_schoolarship',
        'id_rm_schoolarship_student_schoolarship' => 'id_rm_schoolarship_student_schoolarship',
        'id_rm_period_student_schoolarship' => 'id_rm_period_student_schoolarship',
        'id_rm_contract_student_schoolarship' => 'id_rm_contract_student_schoolarship',
        'id_rm_habilitation_establishment_student_schoolarship' => 'id_rm_habilitation_establishment_student_schoolarship',
        'id_rm_establishment_student_schoolarship' => 'id_rm_establishment_student_schoolarship',
        'id_rm_modality_major_student_schoolarship' => 'id_rm_modality_major_student_schoolarship',
        'id_rm_course_type_student_schoolarship' => 'id_rm_course_type_student_schoolarship',
        'schoolarship_order_student_schoolarship' => 'schoolarship_order_student_schoolarship',
        'value_student_schoolarship' => 'value_student_schoolarship',
        'first_installment_student_schoolarship' => 'first_installment_student_schoolarship',
        'last_installment_student_schoolarship' => 'last_installment_student_schoolarship',
        'detail_student_schoolarship' => 'detail_schoolarship_workflow'
    ];


    /**
     * <b>getPrimaryKey</b> Método responsável em retornar o nome da primaryKey.
     * OBS: Não é recomendado que este atributo seja publico, por isso foi realizado o encapsulamento
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    public function workflows(){
        return $this->hasMany(SchoolarshipWorkflow::class, 'fk_student_schoolarship', 'id_student_schoolarship');
    }

}
