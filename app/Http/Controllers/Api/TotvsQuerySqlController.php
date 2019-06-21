<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TotvsTraits\TotvsQuerySqlTrait;
use App\TotvsTraits\TotvsReadRecordTrait;

use App\TotvsTraits\TotvsSaveRecordTrait;


class TotvsQuerySqlController extends Controller
{
    use TotvsQuerySqlTrait , TotvsSaveRecordTrait /*TotvsReadRecordTrait*/;

     /**
     * <b>use ApiControllerTrait</b> Usa a trait e sobreescreve os seus nomes e sua visibilidade, para a classe
     * que esta utilizando a mesma. Sendo assim temos um método index neste classe e um na ApiControllerTrait. 
     * Para não causar conflito é alterado o seu nome exemplo: index as protected indexTrait;
     * Mais informações em: http://php.net/manual/en/language.oop5.traits.php (Changing Method Visibility)
    */
    use ApiControllerTrait
    {

        index as protected indexTrait;
        store as protected storeTrait;
        show as protected showTrait;
        update as protected updateTrait;
        destroy as protected destroyTrait;
    }
   
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$name = self::$nameQuery['WEB001'];
        $parameters = ['CODTIPOCURSO' => '3'];*/

        /*$name = self::$nameQuery['WEB002'];
        $parameters = ['CODFILIAL' => '169', 'CODTIPOCURSO' => '3'];*/

        /*$name = self::$nameQuery['WEB003'];
        $parameters = ['CODFILIAL' => '169', 'CODCURSO' => 'GP011'];*/
        
        /*$name = self::$nameQuery['WEB004'];
        $parameters = ['CODFILIAL' => '-1'];*/

        $name = self::$nameQuery['WEB006'];
        $parameters = ['CODFILIAL' => '101', 'CODCURSO' => 'GP001', 'CODPERLET' => '2018-2', 'RA' => '-1', 'NOMEALUNO' => '-1'];
        $requestSoap = $this->query($name, $parameters);
        return $requestSoap;
    }


    public function totvsQuery(Request $request)
    {
        //verifica se o nome da query não existe
        if(! array_key_exists($request->name, self::$nameQuery))
        {
            $error['message'] = "O Nome da consulta informada não foi encontrada!";
            $error['error']   = true;

            return $this->createResponse($error, 422);

        }

        //altera o nome informado na query pelo nome real da consulta
        $name = self::$nameQuery[$request->name];
        $request->merge(['name' => $name]);
       
        $requestSoap = $this->query($request->name, $request->parameters);

        return $this->createResponse($requestSoap);


    }

   
    /**
     * <b>read</b>
     */
    public function read(Request $request)
    {
        

        return $requestSoap =  $this->readRecord($request->DataServer, $request->PrimaryKey, $request->Contexto);

        
    }


    public function save(Request $request)
    {
      
         return $requestSoap = $this->saveRecord($request->DataServer, $request->XML, $request->Contexto);
    }
}
