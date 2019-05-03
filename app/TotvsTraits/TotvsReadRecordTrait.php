<?php 

namespace App\TotvsTraits;

use Zend\Soap\Client as ZendClient;


Trait TotvsReadRecordTrait 
{

    /**
     * <b>wsdl</b> Endereço relativo do WSDL. O Restante da URL será concatenado no momento das CHAMADAS RPC remote procedure call ou chamada de procedimento remoto
    */
    private $wsdl = 'TOTVSBusinessConnect/wsDataServer.asmx?wsdl';
    
    
    protected function readRecord($dataServer, $primaryKey, $context = null)
    {
        $context = (!is_null($context) ? [$context] : 'CODCOLIGADA=1;CODSISTEMA=S;');

        $parameters = [
            'DataServerName' => $dataServer,
            'PrimaryKey'     => $primaryKey,
            'Contexto'       => $context
        ];

        $url = env('URL_WS_DEVELOPER').$this->wsdl;

        $client = new ZendClient($url, 
                    ['login' => env('USER_WS_TOTVS'), 'password' => env('PASS_WS_TOTVS_REAL')]
                );
        $result = ($client->ReadRecord($parameters));
      
        $response = simplexml_load_string($result->ReadRecordResult);
        
        return $this->transformResponse($response);


    } 

    /**
     * <b>transformResponse<b/> Método responsável por transformar a resposta de xml para json
     * @param $response (Resposta a ser parseada)
     * @return json $reponse
     */
    protected function transformResponse($response)
    {
        return json_encode($response);
    }

   

}

