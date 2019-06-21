<?php

namespace App\TotvsTraits;

use Zend\Soap\Client as ZendClient;
use function GuzzleHttp\json_encode;

Trait TotvsSaveRecordTrait 
{

    /**
     * <b>dom</b> Atributo responsável por guardar a instância da classe DOM do PHP para manipulação e criação do XML
     * OBS:  Para mais informações sobre a classe DOM acesse :  https://www.php.net/manual/pt_BR/class.domdocument.php
     */
    protected $dom;

    /**
     * <b>elements</b> Atributo responsável por guardar os atributos do XML criado. Todos os atributos são indexados 
     * com o mesmo nome de do elemento no XML e também possuem os metodos disponíveis na classe DOM.
     * OBS: Não guarda o root do XML exemplo:
     * <rootXML>
     *      <attribute1>value</attribute>
     * </rootXML>
     */
    protected $elements = [];

    /**
     * <b>rootXml</b> Atributo responsável por aguardar apenas o elemento root do XML, também possui os metodos disponíveis na classe DOM.
     * exemplo:
     * <rootXML>
     *      <attribute1>value</attribute>
     * </rootXML>
     * 
     */
    protected $rootXml;

    /**
     * <b>wsdl</b> Endereço relativo do WSDL. O Restante da URL será concatenado no momento das CHAMADAS RPC remote procedure call ou chamada de procedimento remoto
    */
    private $wsdlSave = 'TOTVSBusinessConnect/wsDataServer.asmx?wsdl';

    /**
     * <b>configureDOM</b> Método responsável por configurar a instância da classe DOM que posteriormente é utilizada para gerar o XML que será utilizado na chamada RPC remote procedure call ou chamada de procedimento remoto
     * ao webservice
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
     * <b>saveRecord</b> Método responsável por receber os dados da requisição, invocar o método que transforma array em XML e fazer a chamada RPC ao webservice
     * @param $dataServer, (DataServerName) 
     * @param $xml (Array com o elemento (indice) e valor de todos os elementos a serem gerado o XML (inclusive o root do XML))
     * @param $context (CODCOLIGADA e CODSISTEMA)
     * @return json $result
     * 
     * OBS: Para mais informações a respeito do webservice acesse: http://tdn.totvs.com/display/public/LRM/Cadastros+-+Webservice
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
        $url = env('URL_WS_DEVELOPER').$this->wsdlSave;
        $client = new ZendClient($url, 
                    ['login' => env('USER_WS_TOTVS'), 'password' => env('PASS_WS_TOTVS_REAL')]
                );
        $result = ($client->SaveRecord($parameters));
      
        return json_encode($result);
   
        
        
    }


    /**
     * <b>arrayToXml</b> Método responsável por indentificar o root do XML (primeiro indice do array xml), invocar o método que configura a instância da classe DOM.
     * varrer o array xml após a definição do rootXML, separar o nome do elemento e o valor e adiciona o mesmo ao rootXML identificado. 
     * @param array $xml (com os elementos e valores do XML a ser criado)
     * @return method $this->generateXml()
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
     * <b>elementXml</b> Método responsável por criar o elemento XML de fato. 
     * Caso o valor do elemento seja nullo informar xsi como valor. 
     * @param $element (elemento do XML)
     * @param $value (valor do elemento XML)
     * @return $this->elements[$element]
     * 
     */
    protected function elementXml($element, $value)
    {
        //caso o valor for nulo 
        if($value == 'xsi')
        {
            $this->elements[$element] = $this->dom->createElement($element);
            $this->elements[$element]->setAttribute('xsi:nil','true');
            $this->elements[$element]->setAttribute('xmlns:xsi','http://www.w3.org/2001/XMLSchema-instance');

            return $this->elements[$element];
        }
        //adicionar o xsi para valores nulos
        return $this->elements[$element] = $this->dom->createElement($element, $value);

    }


    /**
     * <b>generateXml</b> método responsável por adicionar o rootXML a intância do DOM e também por gerar de fato o XML
     * @return XML
     */
    protected function generateXml()
    {   
        
        $this->dom->appendChild($this->rootXml);
        
        return $this->dom->saveXml();
    }



    
}