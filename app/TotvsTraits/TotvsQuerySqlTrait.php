<?php

namespace App\TotvsTraits;

use Zend\Soap\Client as ZendClient;

/**
 * <b>TotvsQuerySqlTrait</b> Trait responsável por utilizar os métodos RPC remote procedure call ou chamada de procedimento remoto do "endpoint"  RealizarConsultaSQL. 
 * Essa chamada RPC consiste em utilizar consultas armazenadas no banco de dados da TOTVS, todas essas consultas são armazenadas 
 * em uma tabela no banco de dados da TOTVS chamada GCONSQL. Essas consultas são chamadas por meio do alias(nome, apelido ) atrelada a mesma
 */
Trait TotvsQuerySqlTrait
{

    /**
     * <b>$nameQuery</b> Array estatico que guarda os nomes dos alias das consultas que serão realizadas
     * OBS: A mesma deverá existir na tabela GCONSQL no TOTVS
     */
    public static $nameQuery = [
        'WEB001' => 'WEB.0001',
        'WEB002' => 'WEB.0002',
        'WEB003' => 'WEB.0003',
        'WEB004' => 'WEB.0004',
        'WEB005' => 'WEB.0005',
        'WEB006' => 'WEB.0006',
        'WEB007' => 'WEB.0007',
        'WEB008' => 'WEB.0008',
        
    ];

   
    /**
     * <b>wsdl</b> Endereço relativo do WSDL. O Restante da URL será concatenado no momento das CHAMADAS RPC remote procedure call ou chamada de procedimento remoto
     */
    private $wsdl = 'TOTVSBusinessConnect/wsConsultaSQL.asmx?wsdl';
    
    /**
     * <b>__set</b> Método mágico do PHP utilizado para setar as propriedades de uma classe. Sem a necessidade de 
     * um metodo set especifico. Responsável por verificar se um determinado atributo existe na trait se existir irá setar os 
     * valores nas propriedades informadas
     * Veja mais em: https://www.php.net/manual/pt_BR/language.oop5.overloading.php#object.set
     */
    public function __set($property, $value)
    {
        if(property_exists('TotvsQuerySqlTrait', (string) $property))
        {
            $this->property = $value;
        }

        $this->property = false;
    }

    /**
     * <b>query</b> Método responsável por fazer a chamada RPC ao webservice que realiza a consulta
     * @param $name (Nome/Alias da consulta)
     * @param $params(Parametros da consulta)
     * @return json  
     */
    protected function query($name, $params, $context = null)
    {
     
        $context = (!is_null($context) ? $context : 'CODCOLIGADA=1;CODSISTEMA=S;');
        
        $parameters = [
            'codSentenca'  => $name, 
            'codColigada'  => '1',         
            'codAplicacao' => 'S',         
            'parameters'   =>  $this->transformParams($params)       
        ];

        $url = env('URL_WS_DEVELOPER').$this->wsdl;
        $client = new ZendClient($url, 
                    ['login' => env('USER_WS_TOTVS'), 'password' => env('PASS_WS_TOTVS')]
                );
          
        $result = ($client->RealizarConsultaSQL($parameters));

        //dd($client->getLastResponse(), $client->getLastResponseHeaders());
       
        //transforma o xml em string e obtem o resultado
        $response = simplexml_load_string($result->RealizarConsultaSQLResult);   
      
        return $response;
        //return $this->transformResponse($response);

    
    }

    /**
     * <b>transformResponse<b/> Método responsável por transformar a resposta de xml para json
     * @param $response (Resposta a ser parseada)
     * @return json $reponse
     * OBS: JSON_UNESCAPED_UNICODE formata o charset
     */
    protected function transformResponse($response)
    {
        return json_encode($response, JSON_UNESCAPED_UNICODE);
    }

    /**
     * <b>transformParams</b> Recebe um array e transforma em uma string personalizada a mesma é utilizada para 
     * passar os parametros para a consulta que será realizada no webservice da TOTVS
     * Exemplo: ['param' => 123, 'param2' => 234] => param=123;param2=234;
     * @param Array $params;
     * @return strin'CODCURSO' => '-1', g $stringParams
     */
    protected function transformParams(Array $params)
    {
       
        $stringParams = [];

        for($i=0; $i<count($params); $i++)
        {
           
            $keys   = array_keys($params);
            $values = array_values($params);
           
            //formata a string no padrão chave=valor; 
            $string = (string) strtoupper($keys[$i]).'='.$values[$i].';';
         
            $stringParams[$i] = $string;
          

        }
      
        //transforma o array em string
        return implode('',$stringParams);
    
        
    }



  

}