<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use SoftDeletes;


    /**
     * <b>table</b> Informa qual é a tabela que o modelo irá utilizar
     */
    public $table = "permissions";


    /**
     * <b>fillable</b> Informa quais colunas é permitido a inserção de dados (MassAssignment)
     *  
     */
    protected $fillable = [
             'name_permission',
             'label_permission'
    ];

    /**
     * <b>CREATED_AT</b> Renomeia o campo padrão created_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */

    const CREATED_AT = 'created_at_permission';
    /**
     * <b>UPDATED_AT</b>  Renomeia o campo padrão updated_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */

    const UPDATED_AT = 'updated_at_permission';
    
    /**
     * <b>DELETED_AT</b> Renomeia o campo padrão deleted_at criado por padrão quando utilizamos a Trait SoftDeletes na model
     * OBS: Essa trait habilita a exclusão logica de registros nativa do Laravel
     */
    const DELETED_AT = 'deleted_at_permission';

   

    /**
     * <b>primaryKey</b> Informa qual a é a chave primaria da tabela
     */
    protected $primaryKey = "id_permission";

    /**
     * <b>dates</b> Serve para tratar todos os campos de data para serem também um objeto do tipo Carbon(biblioteca de datas)
     */

    protected $dates = ['created_at_permission', 'updated_at_permission', 'deleted_at_permission'];

    /**
     * <b>rules</b> Atributo responsável em definir regras de validação dos dados submetidos pelo formulário
     * OBS: A validação bail é responsável em parar a validação caso um das que tenha sido especificada falhe
    */

    public $rules = [
        'name_permission' => 'bail|required|',
        'label_permission' => 'bail|required|',
        
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
        'rn', 
    ];
    /**
     *<b>collection</b> Atributo responsável em informar o namespace e o arquivo do resource
     * O mesmo é utilizado em forma de facade.
     * OBS: Responsável em retornar uma coleção com os alias(apelido) atribuidos para cada coluna. 
     * Mais informações em https://laravel.com/docs/5.5/eloquent-resources
    */
    public $collection = "\App\Http\Resources\PermissionResource::collection";

    /**
     * <b>resource</b>
     */
    public $resource = "\App\Http\Resources\PermissionResource";

    /**
     * <b>map</b> Atributo responsável em atribuir um alias(Apelido), para a colunas do banco de dados
     * OBS: este atributo é utilizado no Metodo store e update da ApiControllerTrait
     */
    public $map = [
        'id'         => 'id_permission',
        'name'       => 'name_permission',
        'label'      => 'label_permission',
        'created_at' => 'created_at_permission', 
        'updated_at' => 'updated_at_permission', 
        'deleted_at' => 'deleted_at_permission'
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
     * <b>roles</b> Método responsável por realizar o relacionamento muito para muitos entre a tabela de permissions e a tabela de roles
     * Sendo o primeiro parametro a model e o segundo a tabela
     * @return type
     */
    
    public function roles()
    {
    
        return $this->belongsToMany(Role::class, 'permission_roles', 'fk_permission', 'fk_role');
        
    }
}
