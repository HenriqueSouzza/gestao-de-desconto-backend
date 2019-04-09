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



Route::resources([
    
    'permissions'      => 'Api\PermissionController',
    'permission-roles' => 'Api\PermissionRoleController',
    'roles'            => 'Api\RoleController',
    'role-users'       => 'Api\RoleUserController',
    'users'            => 'Api\UserController',
    'totvs-queries'    => 'Api\TotvsQuerySqlController'
]);


Route::post('login', 'Api\UserController@login');
Route::post('register', 'Api\UserController@register');

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


Route::get('redirects', 'AuthController@redirect');
Route::post('callback', 'AuthController@callback');


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

   /* $client = new \Zend\Soap\Client('http://10.254.44.147/wsINTEGMOODLE_CNEC/CstImportarNotas.asmx?wsdl', ['login' => '016908139', 'password' => 'd2VzbGV5MjA=']);

    //obtendo informações do servidor SOAP
    echo "informações do servidor SOAP: ";
    print_r($client->getOptions());

    //obtem quais são as funções
    echo "funcionalidades/recursos: ";
    print_r($client->getFunctions());

    //obtem os tipos de dados(struct) dos recursos (especificação dos recursos)
    echo "Tipos:";
    print_r($client->getTypes());

    echo "Consumo/Resultado: ";*/


    //$client = new \Zend\Soap\Client();
    //$client->setWsdl('http://10.254.44.147/wsINTEGMOODLE_CNEC/CstImportarNotas.asmx?wsdl');
    //$client->setOptions(['login' => '016908139', 'password' => "d2VzbGV5MjA="]);
    //$client->setHttpLogin('016908139');
    //$client->setHttpPassword('d2VzbGV5MjA=');
    //RPC - Chamada de procedimento remoto
   /* $client->incluirNotaAvaliacao("
    <SNOTAS>
    <CODCOLIGADA>1</CODCOLIGADA>
    <IDTURMADISC>103621</IDTURMADISC>
    <NOTA>10</NOTA>
    <CODPROVA>12</CODPROVA>
    <CODETAPA>1</CODETAPA>
    <RA>13000006499</RA>
    </SNOTAS>");

    $client->getLastResponseHeaders();*/

      //$client->getErrors();*/

    /*try
    {
        
        $client = new \Zend\Soap\Client('http://10.254.44.147/wsINTEGMOODLE_CNEC/CstImportarNotas.asmx?wsdl', ['login' => '016908139', 'password' => 'd2VzbGV5MjA=']);
        //RPC - Chamada de procedimento remoto
        $client->incluirNotaAvaliacao("
        <SNOTAS>
        <CODCOLIGADA>1</CODCOLIGADA>
        <IDTURMADISC>103621</IDTURMADISC>
        <NOTA>10</NOTA>
        <CODPROVA>12</CODPROVA>
        <CODETAPA>1</CODETAPA>
        <RA>13000006499</RA>  print_r($client->getFunctions());
        </SNOTAS>");

      echo "aqui";

    }
    catch(SoapFault $fault)
    {
        echo "Fault";
        var_dump($fault->getMessage());

    }catch(Exception $e)
    {
        echo "Erro";
        var_dump($e->getMessage());
    }*/

    /*$client = new \Zend\Soap\Client('http://10.254.44.147/wsINTEGMOODLE_CNEC/CstImportarNotas.asmx?wsdl', ['soap_version'=> SOAP_1_1]);

    print_r($client->getFunctions());

    print_r($client->getTypes());


    $client->setHttpLogin('016908139');
    $client->setHttpPassword('MTIzNDU2');


    var_dump($client->getOptions());

    $xmlstring = '<?xml version="1.0" encoding="utf-8"?>
       
          <ArquivoXML>
            <SNOTAS>
                <CODCOLIGADA>1</CODCOLIGADA>
                <IDTURMADISC>103621</IDTURMADISC>
                <NOTA>10</NOTA>
                <CODPROVA>12</CODPROVA>
                <CODETAPA>1</CODETAPA>
                <RA>13000006499</RA>
            </SNOTAS>
            </ArquivoXML>
        ';
    $xml = simplexml_load_string($xmlstring); 

    var_dump($client->IncluirNotaEtapa($xml));*/
    
    /*var_dump($client->IncluirNotaEtapa([
        
            'SNOTAS' => [
                'CODCOLIGADA' => 1,
                'IDTURMADISC'  => 1,
                'NOTA'      => 10,
                'CODPROVA'  => 12,
                'CODETAPA'  => 1, 
                'RA'    => 13000006499
            
        ]
    ]));*/

    /*var_dump($client->getLastRequestHeaders());
    var_dump($client->getLastRequest());
    var_dump($client->getLastSoapOutputHeaderObjects());
    var_dump($client->validateUrn('urn:uuid:8200db4e-13ef-44cc-813c-5d85276dd5d5'));
   

    die();



    die();


    $client->setHttpLogin('016908139');
    $client->setHttpPassword('MTIzNDU2');

    $client->setSoapVersion(1);

    var_dump($client->getOptions());


    var_dump($client->IncluirNotaEtapa('<IncluirNotaAvaliacao>
    <SNOTAS>
    <CODCOLIGADA>1</CODCOLIGADA>
    <IDTURMADISC>103621</IDTURMADISC>
    <NOTA>10</NOTA>
    <CODPROVA>12</CODPROVA>
    <CODETAPA>1</CODETAPA>
    <RA>13000006499</RA>
    </SNOTAS>
    <IncluirNotaAvaliacao>'));


    var_dump($client->call('IncluirNotaAvaliacao', "<SNOTAS>
    <CODCOLIGADA>1</CODCOLIGADA>
    <IDTURMADISC>103621</IDTURMADISC>
    <NOTA>10</NOTA>
    <CODPROVA>12</CODPROVA>
    <CODETAPA>1</CODETAPA>
    <RA>13000006499</RA> 
    </SNOTAS>" )
        );*/

       /* $opts = ['http' => ['header' => "Authorization: Bearer " . $token]];
        $context = stream_context_create($opts);
        $soapClient = new \Zend\Soap\Client($wsdlUrl);
        $soapClient->setSoapVersion(SOAP_1_2);
        $soapClient->setStreamContext($context);*/


       /* $client = new \Zend\Soap\Client('http://10.254.44.147/wsINTEGMOODLE_CNEC/CstImportarNotas.asmx?wsdl');

        $username = '016908139';
        $password = 'MTIzNDU2';
        
        $wssNamespace = "http://docs.oasis-open.org/wss/2004/01/oasis-200401-wss-wssecurity-secext-1.0.xsd";
        
        $username = new \SoapVar($username, 
        XSD_STRING, 
        null, null, 
        'Username', 
        $wssNamespace);
        
        $password = new \SoapVar($password, 
        XSD_STRING, 
        null, null, 
        'Password', 
        $wssNamespace);
        
        $usernameToken = new \SoapVar(array($username, $password), 
        SOAP_ENC_OBJECT, 
        null, null, 'UsernameToken', 
        $wssNamespace);
        
        $usernameToken = new \SoapVar(array($usernameToken), 
        SOAP_ENC_OBJECT, 
        null, null, null, 
        $wssNamespace);
        
       print_r($wssUsernameTokenHeader = new \SoapHeader($wssNamespace, 'Security', $usernameToken)); 
        
       $client->setSoapVersion(SOAP_1_1);
        
       $client->addSoapInputHeader($wssUsernameTokenHeader);
        
        var_dump($client->getOptions());
        
        
        $xml = new \SoapVar("<NewDataSet>
        <IncluirNotaEtapa>
        <STRINGENVIO>
        <SNOTAETAPA>
        <CODCOLIGADA>1</CODCOLIGADA>
        <IDTURMADISC>103621</IDTURMADISC>
        <NOTAFALTA>12</NOTAFALTA>
        <CODETAPA>1</CODETAPA>
        <RA>13000006499</RA>
        </SNOTAETAPA>
        </STRINGENVIO>
        </IncluirNotaEtapa>
        </NewDataSet>"
        , XSD_ANYXML); 


        $xml2 = new \SoapVar("<IncluirNotaEtapa><ArquivoXML><NewDataSet>
        <IncluirNotaEtapa>
        <SNOTAETAPA>
        <CODCOLIGADA>1</CODCOLIGADA>
        <IDTURMADISC>103621</IDTURMADISC>
        <NOTAFALTA>12</NOTAFALTA>
        <CODETAPA>1</CODETAPA>
        <RA>13000006499</RA>
        </SNOTAETAPA>
        </IncluirNotaEtapa>
        </NewDataSet></ArquivoXML></IncluirNotaEtapa>"
        , XSD_ANYXML); 

        /*$prefixStart = 'br';
        $prefixEnd = '/br';

        $xml = new \XMLWriter();
        $xml->openMemory();

        $xml->startElementNs($prefixStart, 'IncluirNotaEtapa', null);
            $xml->startElementNs($prefixStart, 'ArquivoXML', null);
            $xml->endElement();
        $xml->endElement();*/

       /* $prefix = 'br';

        $xml = new \XMLWriter();
        $xml->openMemory();

        
        $xml->startElementNs($prefix, 'IncluirNotaEtapa', null);
      
            $xml->startElementNs($prefix, 'ArquivoXML', null);
       
            $xml->endElement();
        $xml->endElement();


        $request = new SoapVar($xml->outputMemory(), XSD_ANYXML);

        var_dump($request); die();

 

        //$xml->startElementsNS($prefixEnd, 'IncluirNotaEtapa', null);
    
        //$xml->endElement();
       
        
        var_dump($xml->outputMemory()); die();

$request = new SoapVar($xml->outputMemory(), XSD_ANYXML);

        /*$xml3 = new \SoapVar([
            'br:IncluirNotaEtapa' => [
                'br:ArquivoXML' => [
                    'NewDataSet' => [
                        'IncluirNotaAvaliacao' => [
                            'SNOTAS' => [
                                'CODCOLIGADA' => 1,
                                'IDTURMADISC'  => 1,
                                'NOTA'      => 10,
                                'CODPROVA'  => 12,
                                'CODETAPA'  => 1, 
                                'RA'    => 13000006499
                        ],
                    ],
                ],
            ],
            
            ]
        ], XSD_ANYXML);*/
       /* var_dump($client->IncluirNotaEtapa($xml3));
        //var_dump($client->IncluirNotaAvaliacao($xml2));
        
        var_dump($client->getLastRequestHeaders());
        var_dump($client->getLastRequest());
        
        print_r ("<br><br>REQUEST<br>:\n" . htmlentities($client->getLastRequest()). "\n");


  /* $client = new \Zend\Soap\Client('http://10.254.44.147/wsINTEGMOODLE_CNEC/CstImportarNotas.asmx?wsdl', ['login' => '016908139', 'password' => 'MTIzNDU2', 'soap_version'=> SOAP_1_1]);

    print_r($client->getFunctions());

    print_r($client->getTypes());
    

    //$client->setHttpLogin('016908139');
    //$client->setHttpPassword('MTIzNDU2');

    $xml = new \SoapVar("<IncluirNotaEtapa><ArquivoXML><NewDataSet>
    <IncluirNotaEtapa>
    <SNOTAETAPA>
    <CODCOLIGADA>1</CODCOLIGADA>
    <IDTURMADISC>103621</IDTURMADISC>
    <NOTAFALTA>12</NOTAFALTA>
    <CODETAPA>1</CODETAPA>
    <RA>13000006499</RA>
    </SNOTAETAPA>
    </IncluirNotaEtapa>
    </NewDataSet></ArquivoXML></IncluirNotaEtapa>"
    , XSD_ANYXML); 

    var_dump($client->IncluirNotaAvaliacao($xml));

    var_dump($client->getLastRequestHeaders());
    var_dump($client->getLastRequest());*/




  

});