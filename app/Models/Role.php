<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes;

    /**
     * <b>table</b> Informa qual é a tabela que o modelo irá utilizar
    */
    public $table = "roles";

     /**
     * <b>fillable</b> Informa quais colunas é permitido a inserção de dados (MassAssignment)
     *  
     */
    protected $fillable = [
        'name_role',
        'label_role'
    ];

    /**
     * <b>CREATED_AT</b> Renomeia o campo padrão created_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */

    const CREATED_AT = 'created_at_role';
    /**
     * <b>UPDATED_AT</b>  Renomeia o campo padrão updated_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */

    const UPDATED_AT = 'updated_at_role';
    
    /**
     * <b>DELETED_AT</b> Renomeia o campo padrão deleted_at criado por padrão quando utilizamos a Trait SoftDeletes na model
     * OBS: Essa trait habilita a exclusão logica de registros nativa do Laravel
     */
    const DELETED_AT = 'deleted_at_role';

   

    /**
     * <b>primaryKey</b> Informa qual a é a chave primaria da tabela
     */
    protected $primaryKey = "id_role";

    /**
     * <b>dates</b> Serve para tratar todos os campos de data para serem também um objeto do tipo Carbon(biblioteca de datas)
     */

    protected $dates = ['created_at_role', 'updated_at_role', 'deleted_at_role'];

    /**
     * <b>rules</b> Atributo responsável em definir regras de validação dos dados submetidos pelo formulário
     * OBS: A validação bail é responsável em parar a validação caso um das que tenha sido especificada falhe
    */

    public $rules = [
        'name_role'  => 'bail|required|max:50',
        'label_role' => 'bail|required|max:200',
        
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
    public $collection = "\App\Http\Resources\RoleResource::collection";

    /**
     * <b>resource</b>
     */
    public $resource = "\App\Http\Resources\RoleResource";

    /**
     * <b>map</b> Atributo responsável em atribuir um alias(Apelido), para a colunas do banco de dados
     * OBS: este atributo é utilizado no Metodo store e update da ApiControllerTrait
     */
    public $map = [
        'id'         => 'id_role',
        'name'       => 'name_role',
        'label'      => 'label_role',
        'created_at' => 'created_at_role', 
        'updated_at' => 'updated_at_role', 
        'deleted_at' => 'deleted_at_role'
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
     * <b>permissions</b> Método responsável em realizar o relacionamentos de muitos para muitos utilizando a tabela de pivot permission_roles
     *  O relacionamento de muitos para muitos entre a model de Role e Permissions e suas respectivas tabelas. 
     * como primeiro parametro recebe o nome da model, depois o nome da tabela auxilar também conhecida como PIVOT permissions_roles, chave estrangeira de fk_permission (na tabela permissions) e a chave estrangeira
     * de fk_role (na tabela roles)
     * relação de N para N
     * por convenção a tabela auxilar(PIVOT) deve ter o nome no singular e em ordem alfabetica
     * Para ver todas os posts que fazem referencia a uma tag veja o exemplo:
     *  $role = App\Models\Role::find(1)
     *  $role->permissions()->get();
     */

    public function permissions()
    {
        return $this->belongsToMany(Permisson::class, 'permission_roles', 'fk_role', 'fk_permission');
    }



}
