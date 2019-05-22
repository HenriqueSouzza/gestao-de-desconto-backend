<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ConcessionPeriod extends Model
{
    use SoftDeletes;

    /**
     * <b>table</b> Informa qual é a tabela que o modelo irá utilizar
    */
    public $table = "concession_periods";

     /**
     * <b>fillable</b> Informa quais colunas é permitido a inserção de dados (MassAssignment)
     *  
     */
    protected $fillable = [
        'id_rm_establishment_concession_period',
        'id_rm_modality_concession_period' ,
        'id_rm_period_concession_period' ,
        'id_rm_period_code_concession_period' ,
        'date_start_concession_period' ,
        'date_end_concession_period' ,
        'fk_user'
    ];

    /**
     * <b>CREATED_AT</b> Renomeia o campo padrão created_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */

    const CREATED_AT = 'created_at_concession_period';
    /**
     * <b>UPDATED_AT</b>  Renomeia o campo padrão updated_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */

    const UPDATED_AT = 'updated_at_concession_period';
    
    /**
     * <b>DELETED_AT</b> Renomeia o campo padrão deleted_at criado por padrão quando utilizamos a Trait SoftDeletes na model
     * OBS: Essa trait habilita a exclusão logica de registros nativa do Laravel
     */
    const DELETED_AT = 'deleted_at_concession_period';

   

    /**
     * <b>primaryKey</b> Informa qual a é a chave primaria da tabela
     */
    protected $primaryKey = "id_concession_period";

    /**
     * <b>dates</b> Serve para tratar todos os campos de data para serem também um objeto do tipo Carbon(biblioteca de datas)
     */

    protected $dates = ['created_at_concession_period', 'updated_at_concession_period', 'deleted_at_concession_period'];

    /**
     * <b>rules</b> Atributo responsável em definir regras de validação dos dados submetidos pelo formulário
     * OBS: A validação bail é responsável em parar a validação caso um das que tenha sido especificada falhe
    */

    public $rules = [
        'id_rm_establishment_concession_period' => 'required',
        'id_rm_modality_concession_period'      => 'required',
        'id_rm_period_concession_period'        => 'required',
        'id_rm_period_code_concession_period'   => 'required',
        'date_start_concession_period'          => 'required',
        'date_end_concession_period'            => 'required',
        'fk_user'                               => 'required'
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
    public $collection = "\App\Http\Resources\ConcessionPeriodResource::collection";

    /**
     * <b>resource</b>
     */
    public $resource = "\App\Http\Resources\ConcessionPeriodResource";

    /**
     * <b>map</b> Atributo responsável em atribuir um alias(Apelido), para a colunas do banco de dados
     * OBS: este atributo é utilizado no Metodo store e update da ApiControllerTrait
     */
    public $map = [
        'id'                                         => 'id',
        'id_rm_establishment_concession_period'      => 'id_rm_establishment',
        'id_rm_modality_concession_period'           => 'id_rm_modality' ,
        'id_rm_period_concession_period'             => 'id_rm_period' ,
        'id_rm_period_code_concession_period'        => 'id_rm_period' ,
        'date_start_concession_period'               => 'date_start' ,
        'date_end_concession_period'                 => 'date_end' ,
        'fk_user'                                    => 'fk_user',
        'created_at'                                 => 'created_at', 
        'updated_at'                                 => 'updated_at', 
        'deleted_at'                                 => 'deleted_at'
    ];


    /**
     * <b>getPrimaryKey</b> Método responsável em retornar o nome da primaryKey.
     * OBS: Não é recomendado que este atributo seja publico, por isso foi realizado o encapsulamento
     */
    public function getPrimaryKey()
    {
        return $this->primaryKey;
    }
    public function user(){
        return $this->belongsTo(User::class, 'fk_user', 'id');
    }



}
