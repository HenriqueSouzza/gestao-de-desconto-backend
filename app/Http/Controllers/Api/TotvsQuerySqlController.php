<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\TotvsTraits\TotvsQuerySqlTrait;
use App\TotvsTraits\TotvsReadRecordTrait;

use App\TotvsTraits\TotvsSaveRecordTrait;


class TotvsQuerySqlController extends Controller
{
    use TotvsQuerySqlTrait /*TotvsReadRecordTrait,*/ /*TotvsSaveRecordTrait*/;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$name = self::$nameQuery['WEB002'];
        $parameters = ['CODTIPOCURSO' => '-1', 'CODFILIAL' => '-1'];*/
        $name = self::$nameQuery['WEB003'];
        $parameters = ['CODTIPOCURSO' => '-1', 'CODFILIAL' => '-1'];
        $requestSoap = $this->query($name, $parameters);
        return $requestSoap;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**saveRecord
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * <b>read</b>
     */
    public function read(Request $request)
    {
        

        return $requestSoap =  $this->readRecord($request->DataServer, $request->PrimaryKey);

        
    }


    public function save(Request $request)
    {
         return $requestSoap = $this->saveRecord($request->DataServer, $request->XML);
    }
}
