<?php

use Illuminate\Http\Request;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});


Route::group(['middleware' => ['auth:api']], function(){
    
    Route::resources([
        'permissions'      => 'Api\PermissionController',
        'permission-roles' => 'Api\PermissionRoleController',
        'roles'            => 'Api\RoleController',
        'role-users'       => 'Api\RoleUserController',
        'users'            => 'Api\UserController',
        'totvs-queries'    => 'Api\TotvsQuerySqlController'
    ]);

    Route::get('/permissions/update/all', 'Api\PermissionController@updateAllPermissions');
    
});


Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

Route::get('redirect-google', 'Api\UserController@redirectToProvider');
Route::post('callback', 'Api\UserController@callback');

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('logout', 'Api\UserController@logout');
    Route::get('user', 'Api\UserController@user');
});


Route::get('google', function(){
    $url = \Socialite::driver('google')->stateless()->setScopes(['openid', 'email'])->redirect()->getTargetUrl();
  
    //$google = \Socialite::with('google')->stateless()->user();
    $google = \Socialite::driver('google')->stateless()->getTokenUrl();
    dd($google);
   
});



Route::get('soap-tcu', function(){

    $client = new \Zend\Soap\Client('http://contas.tcu.gov.br/debito/CalculoDebito?wsdl');

    //obtendo informações do servidor SOAP
    echo "informações do servidor SOAP: ";
    print_r($client->getOptions());

    //obtem quais são as funções
    echo "funcionalidades/recursos: ";
    print_r($client->getFunctions());

    //obtem os tipos de dados(struct) dos recursos (especificação dos recursos)
    echo "Tipos:";
    print_r($client->getTypes());

    //echo "Consumo/Resultado: ";

    //RPC - Chamada de procedimento remoto

    print_r($client->obterSaldoAtualizado([
        'parcelas' => [
            'parcela' => [
                'data' => '1995-01-01', //data da divida,
                'tipo' => 'D',
                'valor'=> 35
            ],
        ],
        'aplicaJuros'     => true,
        'dataAtualizacao' => '2019-02-20'

    ]));


});

Route::get('totvs', function (){

    $client = new \Zend\Soap\Client('http://10.254.44.175/TOTVSBusinessConnect/wsConsultaSQL.asmx?wsdl', ['login' => 'wsgestaodedesconto', 'password' => 'MjAxOUBjbmVjMDE=']);

    $params = [
        'codSentenca'=> 'WEBS001', // SELECT CHAPA , NOME FROM PFUNC
        'codColigada'=>'1',         
        'codAplicacao'=>'V',         
        'parameters'=>'CPF=04203638151'       
    ];

    //obtendo informações do servidor SOAP
   /* echo "informações do servidor SOAP: ";
    print_r($client->getOptions());

    //obtem quais são as funções
    echo "funcionalidades/recursos: ";
    print_r($client->getFunctions());

    //obtem os tipos de dados(struct) dos recursos (especificação dos recursos)
    echo "Tipos:";
    print_r($client->getTypes());*/

    $result = ($client->RealizarConsultaSQL($params));
    $response = simplexml_load_string($result->RealizarConsultaSQLResult);

    return json_encode($response->Resultado);

});