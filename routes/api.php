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
        'permissions'                 => 'Api\PermissionController',
        'permission-roles'            => 'Api\PermissionRoleController',
        'roles'                       => 'Api\RoleController',        
        'role-users'                  => 'Api\RoleUserController',
        'student-schoolarships'       => 'Api\StudentSchoolarshipController',
        'users'                       => 'Api\UserController',
        'totvs-queries'               => 'Api\TotvsQuerySqlController'
    ]);

    Route::get('/permissions/update/all', 'Api\PermissionController@updateAllPermissions');
    Route::post('/concession-periods/list', 'Api\ConcessionPeriodController@listPeriods'); // lista de periodos letivos dado filial, e modalidade
    Route::post('/discount-margin-schoolarships/list', 'Api\DiscountMarginSchoolarshipController@listMargins'); // lista de periodos letivos dado filial, e modalidade
    Route::post('/student-schoolarships/list-students', 'Api\StudentSchoolarShipController@getStudents');
    
});

Route::post('/totvs-queries/query', 'Api\TotvsQuerySqlController@totvsQuery');
Route::post('/totvs-queries/read', 'Api\TotvsQuerySqlController@read');

Route::post('/totvs-queries/save', 'Api\TotvsQuerySqlController@save');
    
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


Route::get('totvs-data-server', function(){

   // $client = new \Zend\Soap\Client('http://10.254.44.191/TOTVSBusinessConnect/wsDataServer.asmx?wsdl', ['login' => 'wsgestaodedesconto', 'password' => '2019@cnec01']);

    //obtendo informações do servidor SOAP
    /*echo "informações do servidor SOAP: ";
    print_r($client->getOptions());


    //obtem quais são as funções
    echo "funcionalidades/recursos: ";
    print_r($client->getFunctions());



    //obtem os tipos de dados(struct) dos recursos (especificação dos recursos)
    echo "Tipos:";
    print_r($client->getTypes());*/

    /*$xml = "
    <SPessoa>
    <CODIGO>40</CODIGO>
    <SOBRENOME>PEREIRA</SOBRENOME>
    <NOME>THALINE DE BRITO PEREIRA</NOME>
    <CANHOTO>F</CANHOTO>
    <FALECIDO>0</FALECIDO>
    <DTNASCIMENTO>1991-08-18T00:00:00</DTNASCIMENTO>
    <ESTADO>DF</ESTADO>
    <CODUSUARIO>000100442</CODUSUARIO>
    <EMAIL>thaline.pereira@cnec.br</EMAIL>
    <USERID>37b16abd-22a4-4c69-a810-d6c3f39c7f95</USERID>
    <CPF>85368601549</CPF>
    <RUA>QD 02 CJ 03 CASA 30</RUA>
    <BAIRRO>CIDADE ESTRUTURAL</BAIRRO>
    <CEP>71261115</CEP>
    <SEXO>F</SEXO>
    <CARTIDENTIDADE>1598216651</CARTIDENTIDADE>
    <ESTADOCIVIL>S</ESTADOCIVIL>
    <NACIONALIDADE>10</NACIONALIDADE>
    <GRAUINSTRUCAO>9</GRAUINSTRUCAO>
</SPessoa>
";

$request = simplexml_load_string($xml);
    $client->SaveRecord([
        'DataServerName' => 'EduPessoaData',
        'XML'  => $request,
        'Contexto' => 'CODCOLIGADA=1;CODSISTEMA=S;',
    ]);

    $test = $client->getLastResponse();

    dd($test);


    $test = $client->getLastResponse();

    dd($test);

    //dd($client->getFunctions());
    //dd($client->getTypes());*/

    /*$client = new \Zend\Soap\Client('http://10.254.44.191/TOTVSBusinessConnect/wsDataServer.asmx?wsdl', ['login' => 'wsgestaodedesconto', 'password' => '2019@cnec01']);

    $client->ReadRecord([
        'DataServerName' => 'EduBolsaAlunoData',
        'PrimaryKey' => '1;19',
        'Contexto' => 'CODCOLIGADA=1;CODSISTEMA=S;',
    ]);

    print_r($client);

    $test = $client->getLastResponse();

    print_r($test);*/


  $client = new \Zend\Soap\Client('http://10.254.44.191/TOTVSBusinessConnect/wsDataServer.asmx?wsdl', ['login' => 'wsgestaodedesconto', 'password' => '2019@cnec01']);

  $client->ReadRecord([
      'DataServerName' => 'EduBolsaAlunoData',
      'PrimaryKey' => '1;19',
      'Contexto' => 'CODCOLIGADA=1;CODSISTEMA=S;',
  ]);

  print_r($client);

  $test = $client->getLastResponse();

  print_r($test);

    //Instanciamos o objeto passando como valor a versão do XML e o encoding (código de caractéres)
$dom = new DOMDocument('1.0','UTF-8');
 
//Nesse ponto, informamos para o objeto que não queremos espaços em branco no documento
$dom->preserveWhiteSpaces = false;
 
//Aqui, dizemos para o objeto que queremos gerar uma saída formatada
$dom->formatOutput = true;
 
//Pronto! Configurações inicias realizadas, agora partiremos para a criação dos elementos que compõe a árvore do documento XML
//Criação do elemento root (elemento pai)
$root = $dom->createElement('SPessoa');
 
//Vamos criar o elemento nodeOne, conforme o exemplo anterior
$nodeOne = $dom->createElement('CODIGO');
 
//Agora o elemento nodeTwo
$nodeTwo = $dom->createElement('CODUSUARIO');

$nodeTree = $dom->createElement('EMAIL');
 
//criados os elementos, vamos adicionar um valor para cada um deles
$nodeOneTxt = $dom->createTextNode('189058');
$nodeTwoTxt = $dom->createTextNode('000100442');
$nodeTreeText = $dom->createTextNode('henrique.souza21@cnec.br');
 
//Pronto! Elementos criados, o próximo passo é organizar essa bagunça, para isso, usaremos o método appendChild() e diremos quem é elemento pai e quem é elemento filho
$nodeOne->appendChild($nodeOneTxt);
$nodeTwo->appendChild($nodeTwoTxt);
$nodeTree->appendChild($nodeTreeText);
$root->appendChild($nodeOne);
$root->appendChild($nodeTwo);
$root->appendChild($nodeTree);
$dom->appendChild($root);
 
//Dessa forma, dissemos que os elementos nodeOne e nodeTwo são filhos do elemento root, isto é, estão dentro de root ou um nível abaixo de root.
 
//Para imprimir na tela, utilizamos o método saveXML()
// $dom->saveXML();

$client = new \Zend\Soap\Client('http://10.254.44.191/TOTVSBusinessConnect/wsDataServer.asmx?wsdl', ['login' => 'wsgestaodedesconto', 'password' => '2019@cnec01']);

$client->SaveRecord([
    'DataServerName' => 'EduPessoaData',
    'XML'            => $dom->saveXML(),
    'Contexto'       => 'CODCOLIGADA=1;CODSISTEMA=S;',
]);

$test = $client->getLastResponse();

$test2 = $client->getLastResponseHeaders();

dd($test, $test2);










});