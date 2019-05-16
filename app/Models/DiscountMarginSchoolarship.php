<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\User;

class DiscountMarginSchoolarship extends Model
{
    use SoftDeletes;

    /**
     * <b>table</b> Informa qual é a tabela que o modelo irá utilizar
    */
    public $table = "discount_margin_schoolarships";

     /**
     * <b>fillable</b> Informa quais colunas é permitido a inserção de dados (MassAssignment)
     *  
     */
    protected $fillable = [        
        'id_rm_establishment_discount_margin_schoolarship',
        'id_rm_course_type_discount_margin_schoolarship',
        'id_rm_modality_discount_margin_schoolarship',
        'id_rm_major_discount_margin_schoolarship',
        'id_rm_period_discount_margin_schoolarship',
        'id_rm_period_code_discount_margin_schoolarship',
        'max_value_discount_margin_schoolarship',
        'is_exact_value_discount_margin_schoolarship',
        'fk_user'
    ];

    /**
     * <b>CREATED_AT</b> Renomeia o campo padrão created_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */

    const CREATED_AT = 'created_at_discount_margin_schoolarship';
    /**
     * <b>UPDATED_AT</b>  Renomeia o campo padrão updated_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */

    const UPDATED_AT = 'updated_at_discount_margin_schoolarship';
    
    /**
     * <b>DELETED_AT</b> Renomeia o campo padrão deleted_at criado por padrão quando utilizamos a Trait SoftDeletes na model
     * OBS: Essa trait habilita a exclusão logica de registros nativa do Laravel
     */
    const DELETED_AT = 'deleted_at_discount_margin_schoolarship';

   

    /**
     * <b>primaryKey</b> Informa qual a é a chave primaria da tabela
     */
    protected $primaryKey = "id_discount_margin_schoolarship";

    /**
     * <b>dates</b> Serve para tratar todos os campos de data para serem também um objeto do tipo Carbon(biblioteca de datas)
     */

    protected $dates = ['created_at_discount_margin_schoolarship', 'updated_at_discount_margin_schoolarship', 'deleted_at_discount_margin_schoolarship'];

    /**
     * <b>rules</b> Atributo responsável em definir regras de validação dos dados submetidos pelo formulário
     * OBS: A validação bail é responsável em parar a validação caso um das que tenha sido especificada falhe
    */

    public $rules = [        
        'id_rm_establishment_discount_margin_schoolarship'  => 'required',
        'id_rm_course_type_discount_margin_schoolarship'    => 'required',
        'id_rm_modality_discount_margin_schoolarship'       => 'required',
        'id_rm_major_discount_margin_schoolarship'          => 'required',
        'id_rm_period_discount_margin_schoolarship'         => 'required',
        'id_rm_period_code_discount_margin_schoolarship'    => 'required',
        'max_value_discount_margin_schoolarship'            => 'required',
        'is_exact_value_discount_margin_schoolarship'       => 'required',
        'fk_user'                                           => 'required'
        
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
