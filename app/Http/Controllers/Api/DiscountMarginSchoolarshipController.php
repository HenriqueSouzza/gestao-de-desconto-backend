<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Api\ApiControllerTrait;

use App\Models\DiscountMarginSchoolarship;

class DiscountMarginSchoolarshipController extends Controller
{
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
     * <b>model</b> Atributo responsável em guardar informações a respeito de qual model a controller ira utilizar. 
     * Por causa do D.I (injeção de dependencia feita) o mesmo armazena um objeto da classe que ira ser utilizada.
     * OBS: Este atributo é utilizado na ApiControllerTrait, para diferenciar qual classe esta utilizando os seus recursos
     */

     protected $model;

    /**
     * <b>relationships</b> Atributo responsável em guardar informações sobre relacionamentos especificados na models
     * Estes relacionamentos são utilizados entre as models e suas respectivas tabelas.
     * OBS: Caso tenha algum relacionamento na model o mesmo deverá ser descrito o nome do mesmo aqui, para que a ApiControllerTrait
     * Possa utilizar o mesmo em seu método with() presente na consulta do metodo index
     */
     protected $relationships = [];
     
     /**
     * <b>__construct</b> Método construtor da classe. O mesmo é utilizado, para que atribuir qual a model será utilizada.
     * Essa informação atribuida aqui, fica disponivel na ApiControllerTrait e é utilizada pelos seus metodos.
     */
     public function __construct(DiscountMarginSchoolarship $model)
     {
         $this->model = $model;
     }
     /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return $this->indexTrait($request);
    }

    /**
     * Lista os periodos vigentes com os parametros passados
     * CODFILIAL(codFilial), MODALIDADE(P/D)(modality)
     */
    public function listMargins(Request $request){        
        $codFilial = $request->codFilial;
        $modality = $request->modality;
        $codPerlet = $request->codPerlet;
        $codCurso = $request->codCurso;        
        $margins = DiscountMarginSchoolarship::where([
                          'id_rm_establishment_discount_margin_schoolarship' => $codFilial,
                          'id_rm_modality_discount_margin_schoolarship' => $modality,
                          'id_rm_major_discount_margin_schoolarship' => $codCurso,
                          'id_rm_period_code_discount_margin_schoolarship' => $codPerlet])
                         ->where('id_rm_schoolarship_discount_margin_schoolarship', '<>', 8) // removendo as bolsas que sao do cct
                         ->where('id_rm_schoolarship_discount_margin_schoolarship', '<>', 2)
                         ->where('id_rm_schoolarship_discount_margin_schoolarship', '<>', 29)
                         ->where('id_rm_schoolarship_discount_margin_schoolarship', '<>', 3)

                         ->get();
        
        
        return $this->createResponse($margins, 200);
    }
    public function import(Request $request){   
      
        if($request->file->store('imports'));
            return "Armazenado com sucesso";
        return "Problema na armazenacao";
        
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        return $this->storeTrait($request);
    }    

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return $this->showTrait($id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        return $this->updateTrait($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $destroy = $this->destroyTrait($id);
        return $destroy;

    }
}
