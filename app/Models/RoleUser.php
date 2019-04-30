<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\User;

class RoleUser extends Model
{
    
    use SoftDeletes;

    /**
     * <b>table</b> Informa qual é a tabela que o modelo irá utilizar
    */
    public $table = "role_users";

     /**
     * <b>fillable</b> Informa quais colunas é permitido a inserção de dados (MassAssignment)
     *  
     */
    protected $fillable = [
        'fk_role',
        'fk_user'
    ];

    /**
     * <b>CREATED_AT</b> Renomeia o campo padrão created_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */

    const CREATED_AT = 'created_at_role_user';
    /**
     * <b>UPDATED_AT</b>  Renomeia o campo padrão updated_at criado por padrão quando utilizamos o metodo timestamps() na migration
     */

    const UPDATED_AT = 'updated_at_role_user';
    
    /**
     * <b>DELETED_AT</b> Renomeia o campo padrão deleted_at criado por padrão quando utilizamos a Trait SoftDeletes na model
     * OBS: Essa trait habilita a exclusão logica de registros nativa do Laravel
     */
    const DELETED_AT = 'deleted_at_role_user';

   

    /**
     * <b>primaryKey</b> Informa qual a é a chave primaria da tabela
     */
    protected $primaryKey = "id_role_user";

    /**
     * <b>dates</b> Serve para tratar todos os campos de data para serem também um objeto do tipo Carbon(biblioteca de datas)
     */

    protected $dates = ['created_at_role_user', 'updated_at_role_user', 'deleted_at_role_user'];

    /**
     * <b>rules</b> Atributo responsável em definir regras de validação dos dados submetidos pelo formulário
     * OBS: A validação bail é responsável em parar a validação caso um das que tenha sido especificada falhe
    */

    public $rules = [
        'fk_role' => 'bail|required|',
        'fk_user' => 'bail|required|',
        
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
    public $collection = "\App\Http\Resources\RoleUserResource::collection";

    /**
     * <b>resource</b>
     */
    public $resource = "\App\Http\Resources\RoleUserResource";

    /**
     * <b>map</b> Atributo responsável em atribuir um alias(Apelido), para a colunas do banco de dados
     * OBS: este atributo é utilizado no Metodo store e update da ApiControllerTrait
     */
    public $map = [
        'id'         => 'id_role_user',
        'role'       => 'fk_role',
        'user'       => 'fk_user',
        'created_at' => 'created_at_role_user', 
        'updated_at' => 'updated_at_role_user', 
        'deleted_at' => 'deleted_at_role_user'
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
     * <b>roles</b> Método responsável em definir o relacionamento entre as de RoleUser  e Role e suas
     * respectivas tabelas.
     */
    public function role()
    {

        return $this->belongsTo(Role::class, 'fk_role', 'id_role');
    }

    /**
     * <b>user</b> Método responsável em definir o relacionamento entre as Models de RoleUser e User e suas
     * respectivas tabelas.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'fk_user', 'id');
    }


    ///////////////////////////////////////////////////////////////////
   ///////////////////// REGRAS DE NEGOCIO ////////////////////////////
   ///////////////////////////////////////////////////////////////////


    /**
    * <b>ruleUnique</b> Método responsável em realizar a seguinte verificação:
    * REGRA : Verifica se o usuário já foi possui o papel informado,  caso seja verdadeiro retornará uma mensagem de erro
    * caso contrario retorna true
    * @param $idUser (id do usuário)
    * @param $idRole (id do papel)
    */

    public function ruleUnique($idUser, $idRole)
    {
        $query = (Object) $this->whereRaw("fk_user={$idUser} AND fk_role={$idRole}");
        
        if(! is_null($query))
        {
            $count = $query->get()->count();
            
            if($count >= 1)
            {
                $error['message'] = "Usuário já foi atribuido a esse papel!";
                $error['error']   = true;

                return $error;
            }

            
        }

        return true;

      
    }



}
