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
    public $table = 'student_schoolarships';

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
        'id_rm_service_student_schoolarship',
        'detail_student_schoolarship',
        'active_student_schoolarship',
        'send_rm_student_schoolarship',
        'id_rm_student_schoolarship'       
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
    protected $primaryKey = 'id_student_schoolarship';

    /**
     * <b>dates</b> Serve para tratar todos os campos de data para serem também um objeto do tipo Carbon(biblioteca de datas)
     */

    protected $dates = ['created_at_student_schoolarship', 'updated_at_student_schoolarship', 'deleted_at_student_schoolarship'];

    /**
     * <b>rules</b> Atributo responsável em definir regras de validação dos dados submetidos pelo formulário
     * OBS: A validação bail é responsável em parar a validação caso um das que tenha sido especificada falhe
    */

    public $rules = [
        'ra_rm_student_schoolarship'                            => 'required',
        'id_rm_schoolarship_student_schoolarship'               => 'required|',
        'id_rm_period_student_schoolarship'                     => 'required|',
        'id_rm_contract_student_schoolarship'                   => 'required|',
        'id_rm_habilitation_establishment_student_schoolarship' => 'required|',
        'id_rm_establishment_student_schoolarship'              => 'required|',
        'id_rm_modality_major_student_schoolarship'             => 'required|',
        'id_rm_course_type_student_schoolarship'                => 'required|',
        'schoolarship_order_student_schoolarship'               => 'required|',
        'value_student_schoolarship'                            => 'required|',
        'first_installment_student_schoolarship'                => 'required|min:1|max:12',
        'last_installment_student_schoolarship'                 => 'required|min:1|max:12', 
        'id_rm_service_student_schoolarship'                    => 'required|min:1|max:2',
        'detail_student_schoolarship'                           => 'nullable|max:250',
        'active_student_schoolarship'                           => 'required|boolean',
        'send_rm_student_schoolarship'                          => 'required|boolean',
        'id_rm_student_schoolarship'                            => 'nullable|numeric',
        
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
        'id'                   => 'id_student_schoolarship',
        'ra'                   => 'ra_rm_student_schoolarship',
        'establishment'        => 'id_rm_establishment_student_schoolarship',
        'schoolarship'         => 'id_rm_schoolarship_student_schoolarship',
        'schoolarship_order'   => 'schoolarship_order_student_schoolarship',
        'student_schoolarship' => 'id_rm_student_schoolarship',
        'value'                => 'value_student_schoolarship',
        'first_installment'    => 'first_installment_student_schoolarship',
        'last_installment'     => 'last_installment_student_schoolarship',
        'service'              => 'id_rm_service_student_schoolarship',
        'period'               => 'id_rm_period_student_schoolarship',
        'contract'             => 'id_rm_contract_student_schoolarship',
        'habilitation'         => 'id_rm_habilitation_establishment_student_schoolarship',
        'modality_major'       => 'id_rm_modality_major_student_schoolarship',
        'course_type'          => 'id_rm_course_type_student_schoolarship',
        'detail'               => 'detail_student_schoolarship',
        'active'               => 'active_student_schoolarship',
        'send_rm'              => 'send_rm_student_schoolarship',
        'created_at'           => 'created_at_student_schoolarship', 
        'updated_at'           => 'updated_at_student_schoolarship', 
        'deleted_at'           => 'deleted_at_student_schoolarship'        
    ];


    /**
     * <b>getPrimaryKey</b> Método responsável em retornar o nome da primaryKey.
     * OBS: Não é recomendado que este atributo seja publico, por isso foi realizado o encapsulamento
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }

    /**
     * <b>workflows</b> Método responsável em definir o relacionamento entre as Models de StudentSchoolarship e SchoolarshipWorkflow e suas
     * respectivas tabelas.
     */
    public function workflows()
    {
        return $this->hasMany(SchoolarshipWorkflow::class, 'fk_student_schoolarship', 'id_student_schoolarship');
    }


    ///////////////////////////////////////////////////////////////////
   ///////////////////// REGRAS DE NEGOCIO ////////////////////////////
   ///////////////////////////////////////////////////////////////////

   /**
    * <b>ruleDuplicateSchoolarship</b> Regra de négócio responsável por verificar se a bolsa que esta sendo inserida já existe, 
    * caso exista irá desativar as bolsas e retornar os IDBOLSAALUNO(dado referente a TABELA SBOLSAALUNO DO TOTVS) para poder desativar
    * lá também 
    * @param $ra (matricula do aluno)
    * @param $contract (contrato do aluno)
    * @param $schoolarship (bolsa)
    * @param $period (pérido letivo)
    * @param $firstInstallment (parcela inicial)
    * @param $lastInstallment (parcela final)
    * @return false (caso não exista) ou array caso exista
    */
   public function ruleDuplicateSchoolarship($ra, $contract, $schoolarship, $period, $firstInstallment, $lastInstallment)
   {
   
        $query = $this->whereRaw("ra_rm_student_schoolarship={$ra} AND id_rm_contract_student_schoolarship={$contract} 
                                 AND id_rm_schoolarship_student_schoolarship={$schoolarship} AND id_rm_period_student_schoolarship={$period}
                                 AND first_installment_student_schoolarship={$firstInstallment} AND last_installment_student_schoolarship={$lastInstallment}
                                 AND active_student_schoolarship=1");

        if($query->count() >= 1)
        {
           $schoolarships = $query->get();
           foreach($schoolarships as $schoolarship)
           {
               $data['active_student_schoolarship'] = 0;
               $update = $this->where('id_student_schoolarship', $schoolarship->id_student_schoolarship)->update($data);
           }
           //retornar os ids do schoolarships

        }
       
        return false;
   }

}
