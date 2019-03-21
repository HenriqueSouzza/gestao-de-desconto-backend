<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Passport\HasApiTokens;

use App\Models\RoleUser;

class User extends Authenticatable
{
    use Notifiable, SoftDeletes, HasApiTokens;

    /**
     * <b>table</b>
     */
    public $table = "users";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
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
     * The attributes that should be hidden for arrays.
     *
     * @var array
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
     * <b>CREATED_AT</b>
     */
    const CREATED_AT = "created_at";

    /**
     * <b>UPDATED_AT</b>
     */
    const UPDATED_AT = "updated_at";

    /**
     *<b>DELETED_AT</b> 
     */

     const DELETED_AT = "deleted_at";

   
     /**
      * <b>primaryKey</b>
      */
     protected $primaryKey = "id";

    /**
     * <b>dates</b> Serve para tratar todos os campos de data para serem também um objeto do tipo Carbon(biblioteca de datas)
     */
    protected $dates = ['created_at', 'updated_at', 'deleted_at', 'email_verified_at'];

    /**
     * <b>rules</b>
     */
    public $rules = [

        'name'     => 'bail|required',
        'email'    => 'bail|required',
        'password' => 'bail|required'
    ];

    /**
     * <b>messages</b>
     */
    public $messages = [

    ];

    /**
     * <b>collection</b>
     */

     public $collection = "";

     /**
      * <b>resource</b>
      */

    public $resource = "";

    /**
     * <b>map</b>
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
     * <b>getPrimaryKey</b>
     */

     public function getPrimaryKey()
     {
         return $this->primaryKey;
     }

     
}
