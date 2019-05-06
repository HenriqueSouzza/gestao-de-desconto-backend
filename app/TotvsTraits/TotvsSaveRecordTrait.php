<?php

namespace App\TotvsTraits;

use Zend\Soap\Client as ZendClient;
use function GuzzleHttp\json_encode;

Trait TotvsSaveRecordTrait 
{

    protected $dom;

    protected $elements = [];

    protected $rootXml;

    /**
     * <b>wsdl</b> Endereço relativo do WSDL. O Restante da URL será concatenado no momento das CHAMADAS RPC remote procedure call ou chamada de procedimento remoto
    */
    private $wsdl = 'TOTVSBusinessConnect/wsDataServer.asmx?wsdl';

    /**
     * 
     */
    protected function configureDOM($rootXml)
    {
     
        $this->dom = new \DOMDocument('1.0','UTF-8');

        $this->dom->preserveWhiteSpaces = false;

        $this->dom->formatOutput = true;

        $this->rootXml = $this->dom->createElement($rootXml);

        return $this->dom;
    }


    /**
     * 
     */
    protected function saveRecord($dataServer, Array $xml, $context = null)
    {

        $context = (!is_null($context) ? $context : 'CODCOLIGADA=1;CODSISTEMA=S;');

        $parameters = [
            'DataServerName' => $dataServer,
            'XML'            => $this->arrayToXml($xml),
            'Contexto'       => $context
        ];

        //fazer a chamada RPC
        $url = env('URL_WS_DEVELOPER').$this->wsdl;
        $client = new ZendClient($url, 
                    ['login' => env('USER_WS_TOTVS'), 'password' => env('PASS_WS_TOTVS_REAL')]
                );
        $result = ($client->SaveRecord($parameters));
       
        // $response['action'] = 'SaveRecordResult';
        // $response['id'] = $result->SaveRecordResult;

        return json_encode($result);
   
        
        
    }


    /**
     * 
     */
    protected function arrayToXml(Array $xml)
    {
      
        $rootXml = array_keys($xml)[0];

        $this->configureDOM($rootXml);
   
       foreach ($xml[$rootXml] as $elementXml => $key)
       {
         
           $element = array_keys($key)[0]; 
           $value = $key[$element]; 

           $this->elementXml($element, $value);

           $this->rootXml->appendChild($this->elements[$element]);
           
           
       }

       return $this->generateXml();
      

    }

    /**
     * 
     */
    protected function elementXml($element, $value)
    {
     
        return $this->elements[$element] = $this->dom->createElement($element, $value);

    }


    /**
     * 
     */
    protected function generateXml()
    {   
        
        $this->dom->appendChild($this->rootXml);
        return $this->dom->saveXml();
    }



    
}