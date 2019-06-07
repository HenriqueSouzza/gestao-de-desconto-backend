<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

use App\Models\Role;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    /**
     * <b>table</b> Informa qual é a tabela que o modelo irá utilizar
     */
    public $table = "users";

    /**
     * <b>fillable</b> Informa quais colunas é permitido a inserção de dados (MassAssignment)
     *  
     */
    protected $fillable = [
        'name', 
        'email', 
        'password',
        'provider',
        'provider_id',
        'email_verified_at'
    ];

    /**
     * <b>hidden</b> Atributo responsável em esconder colunas que não deverão ser retornadas em uma requisição
    */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * <b>CREATED_AT</b> Renomeia o campo padrão created_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */
    const CREATED_AT = "created_at";

    /**
     * <b>UPDATED_AT</b> Renomeia o campo padrão updated_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */
    const UPDATED_AT = "updated_at";

    /**
     *<b>DELETED_AT</b> Renomeia o campo padrão deleted_at criado por padrão quando utilizamos a Trait SoftDeletes na model
     * OBS: Essa trait habilita a exclusão logica de registros nativa do Laravel
     */

     const DELETED_AT = "deleted_at";

   
     /**
      * <b>primaryKey</b> Informa qual a é a chave primaria da tabela
      */
     protected $primaryKey = "id";

    /**
     * <b>dates</b> Serve para tratar todos os campos de data para serem também um objeto do tipo Carbon(biblioteca de datas)
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'email_verified_at'];

    /**
     * <b>rules</b> Atributo responsável em definir regras de validação dos dados submetidos pelo formulário
     * OBS: A validação bail é responsável em parar a validação caso um das que tenha sido especificada falhe
    */
    public $rules = [

        'name'     => 'bail|required',
        'email'    => 'bail|required',
        'password' => 'bail|required'
    ];

    /**
     * <b>messages</b> Atributo responsável em definir mensagem de validação de acordo com as regras especificadas no atributo $rules
     */
    public $messages = [

    ];

     /**
     *<b>collection</b> Atributo responsável em informar o namespace e o arquivo do resource
     * O mesmo é utilizado em forma de facade.
     * OBS: Responsável em retornar uma coleção com os alias(apelido) atribuidos para cada coluna. 
     * Mais informações em https://laravel.com/docs/5.8/eloquent-resources
    */

     public $collection = "\App\Http\Resources\UserResource::collection";

     /**
      * <b>resource</b>
      */

    public $resource = "\App\Http\Resources\UserResource";

    /**
     * <b>map</b> Atributo responsável em atribuir um alias(Apelido), para a colunas do banco de dados
     * OBS: este atributo é utilizado no Metodo store e update da ApiControllerTrait
     */
     public $map = [
        'id'             => 'id',
        'name'           => 'name',
        'password'       => 'password',
        'provider'       => 'provider',
        'provider_id'    => 'provider_id',
        'email_verified' => 'email_verified_at',
        'created_at'     => 'created_at',
        'updated_at'     => 'updated_at',
        'deleted_at'     => 'deleted_at',
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
     * Relacionamento de user roles
     */
    public function roles(){
        return $this->belongsToMany(Role::class, 'role_users', 'fk_user', 'fk_role');
    }
}
