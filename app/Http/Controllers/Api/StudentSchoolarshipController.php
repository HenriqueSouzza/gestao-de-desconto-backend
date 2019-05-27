<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;

use App\Http\Controllers\Api\ApiControllerTrait;

use App\Models\SchoolarshipWorkflow;
use App\Models\StudentSchoolarship;

use App\TotvsTraits\TotvsQuerySqlTrait;


class StudentSchoolarShipController extends Controller
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
     * <b>use TotvsQuerySqlTrait</b> Usa a trait e sobreescreve os nomes de alguns de seus métodos e sua visibilidade
     * Mais informações em: http://php.net/manual/en/language.oop5.traits.php (Changing Method Visibility)
     */
    use TotvsQuerySqlTrait;
    
   
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

     protected $response = [];
     
     /**
     * <b>__construct</b> Método construtor da classe. O mesmo é utilizado, para que atribuir qual a model será utilizada.
     * Essa informação atribuida aqui, fica disponivel na ApiControllerTrait e é utilizada pelos seus metodos.
     */
     public function __construct(StudentSchoolarship $model)
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
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {        
        $schoolarship = $this->storeTrait($request);
        dd($schoolarship);
        // if($request->first_installment_student_schoolarship == $request->last_installment_student_schoolarship)
        // {
        //     $schoolarship = $this->storeOne($request);
        //     return $this->createResponse($schoolarship, 201);
        // }
        // else
        // {
        //     // Criando varias entradas com parcela inicial e final igual
        //     $first = $request->first_installment_student_schoolarship;
        //     $last = $request->last_installment_student_schoolarship;
        //     for($i = $first; $i <= $last; $i=$i+1 )
        //     {                
        //         $temp = clone $request;                
        //         $temp['first_installment_student_schoolarship'] = $temp['last_installment_student_schoolarship'] = $i;                                       
        //         $schoolarship = $this->storeOne($temp);
        //     }
        //     return $this->createResponse($schoolarship, 201);
        // }
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


    /**
     * Display faz inserção apenas sem retornar resposta
     * @param  \Illuminate\Http\Request  $request
     * @return \App\Models\StudentSchoolarship
     */
    private function storeOne(Request $request)
    {
        $schoolarship = $this->model->create($request->all());  

        //insere no historico a ação
        SchoolarshipWorkflow::create(
            [
                'fk_student_schoolarship'      => $schoolarship->id_student_schoolarship,
                'fk_action'                    => 1, // CRIACAO
                'fk_user'                      => $request->fk_user, //TODO: Pegar id do usuario
                'detail_schoolarship_workflow' => 'Detalhe sobre o passo'
            ]
        );

        return $schoolarship;
    }


    ///////////////////////////////////////////////////////////////////////
   ///////////////////// WEBSERVICE TOTVS SOAP METHODS ////////////////////
  ////////////////////////////////////////////////////////////////////////

  /**
   * <b>getStudents<b/> Método responsavel por obter os dados dos estudantes para isso devem ser informados os seguintes dados:
  */
  protected function getStudents(Request $request)
  {
  
    $validator = Validator::make($request->all(), [
        'codfilial' => 'required|numeric|min:1',
        'codcurso'  => 'required|string',
        'codperlet' => 'required',
        'ra'        => 'required|numeric',
        'nomealuno' => 'required|'
    ]);

    if($validator->fails())
    {    
        $error['message'] = $validator->errors();
        $error['error']   = true;

        return  $this->createResponse($error, 422);
    }

    $name = self::$nameQuery['WEB006'];

    $parameters = [
                    'CODFILIAL' => $request->codfilial, 
                    'CODCURSO'  => $request->codcurso, 
                    'CODPERLET' => $request->codperlet, 
                    'RA'        => $request->ra, 
                    'NOMEALUNO' => $request->nomealuno
                ];

    $requestSoap = (array) $this->query($name, $parameters);

    $schoolarship = $this->getSchoolarship($request);

    $responseSoap = $this->formatResponse($requestSoap, $schoolarship);
    return $this->createResponse($responseSoap);
   
  }

  /**
   * <b>formatResponse</b> Método responsável por trabalhar os dados de estudantes e de bolsas dos estudantes, separa as bolsas anteriores das
   * bolsas atuais e chamar o método printResponse e retornar o dado.
   * @param $dataStudent (dados dos estudantes)
   * @param $dataSchoolarship (dados das bolsas)
   * OBS: Ajuda a "mergiar" os dados tendo em vista que nos dados de bolsas  é retornado apenas o RA do aluno
   */
  protected function formatResponse(Array $dataStudent, Array $dataSchoolarship)
  {

    $beforeSchoolarship = [];
    $afterSchoolarship = [];
    //caso so tenha um registro irá contar os objetos
    if(count($dataStudent['Resultado']) == 12)
    {
         $result = $dataStudent['Resultado'];
         $ra = (string) $result->RA;
         //pesquisa se nas bolsas obtidas possui o RA do aluno 
         for($i = 0; $i <count($dataSchoolarship); $i++)
         {
             $data = (array) $dataSchoolarship[$i];
             if(in_array($ra, $data))
             {
                 //obtem as bolsas anteriores
                if(in_array('ANTERIOR', $data))
                {
                    $beforeSchoolarship[] = $data;
                   
                }else{
                    $afterSchoolarship[] = $data;
                }
               
             }
            
         }

         $this->response[] = $this->printResponse($result, $beforeSchoolarship, $afterSchoolarship);
        
    }//caso tenha mais de um aluno 
    else
    {
        foreach($dataStudent['Resultado'] as $result)
        {
            $check = false;
            $ra = (string) $result->RA;
            //pesquisa se nas bolsas obtidas possui o RA do aluno 
            for($i = 0; $i <count($dataSchoolarship); $i++)
            {
                $data = (array) $dataSchoolarship[$i];
              
                if(in_array($ra, $data))
                {
                    $check = true;
                    //obtem as bolsas anteriores
                   if(in_array('ANTERIOR', $data))
                   {
                       $beforeSchoolarship[$ra][] = $data;
                      
                   }else{
                       $afterSchoolarship[$ra][] = $data;
                   }

                }
               
            }
            if($check)
            {
                $before = (array_key_exists($ra, $beforeSchoolarship) ? $beforeSchoolarship[$ra] : '');
                $after = (array_key_exists($ra, $afterSchoolarship) ? $afterSchoolarship[$ra] : '');
                $this->response[] = $this->printResponse($result, $before , $after);
            }
           
          
          
         
         }

   
    }
   
    
    return $this->response;

  }


  /**
   * <b>getSchoolarship</b> Método responsavel por obter as bolsas dos estudantes para isso devem ser informados os seguintes dados:
   * codfilial, codcurso, codperlet, ra, nomealuno
   * exemplo:
   * codfilial : 169,
   * codcurso : GP006,
   * codperlet : 2019-1,
   * ra : -1,
   * nomealuno : -1
   * OBS: Caso não possua um determinado dado para pesquisa informar -1
   *
   */
  protected function getSchoolarship(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'codfilial' => 'required|numeric|min:1',
        'codcurso'  => 'required|string',
        'codperlet' => 'required',
        'ra'        => 'required|numeric',
        'nomealuno' => 'required|'
    ]);

    if($validator->fails())
    {    
        $error['message'] = $validator->errors();
        $error['error']   = true;

        return  $this->createResponse($error, 422);
    }

    $name = self::$nameQuery['WEB009'];

    $parameters = [
                    'CODFILIAL' => $request->codfilial, 
                    'CODCURSO'  => $request->codcurso, 
                    'CODPERLET' => $request->codperlet, 
                    'RA'        => $request->ra, 
                    'NOMEALUNO' => $request->nomealuno
                ];

    $requestSoap = (array) $this->query($name, $parameters);
    return $requestSoap['Resultado'];


  }


  /**
   * <b>printResponse<b/> Método responsável por formatar a resposta no padrão desejado
   * @param $result (dados dos estudantes)
   * @param $beforeSchoolarship (bolsas anteriores)
   * @param $afterSchoolarship (bolsas atuais)
   */
  protected function printResponse($result, $beforeSchoolarship, $afterSchoolarship )
  {
      return [
        'dados' => [
            'ra'                => (string) $result->RA,
            'aluno'             => (string) $result->ALUNO,
            'codfilial'         => (string) $result->CODFILIAL,
            'filial'            => (string) $result->FILIAL,
            'codcurso'          => (string) $result->CODCURSO,
            'curso'             => (string) $result->CURSO,
            'codperlet'         => (string) $result->CODPERLET,
            'idperlet'          => (string) $result->IDPERLET,
            'valor_mensalidade' => (string) $result->VALOR_MENSALIDADE,
            'tipo_aluno'        => (string) $result->TIPO_ALUNO, 
            'modalidade'        => (string) $result->MODALIDADE,  
        ],
        'bolsas_anteriores'     => $beforeSchoolarship,
        'bolsas_atuais'         => $afterSchoolarship
    ];

    
  }


  /**
   * 
   */
  protected function postSchoolarship(Request $request)
  {
    $validator = Validator::make($request->all(), [
        'discounts' => 'required|array'
    ]);

    if($validator->fails())
    {    
        $error['message'] = $validator->errors();
        $error['error']   = true;

        return  $this->createResponse($error, 422);
    }

    foreach($request->discounts as $discount)
    {
        $validator = Validator::make($discount, [
            'ra'                 => 'required',
            'establishment'      => 'required',
            'schoolarship'       => 'required',
            'schoolarship_order' => 'required',
            'value'              => 'required',
            'first_installment'  => 'required|numeric|min:1',
            'last_installment'   => 'required|numeric|max:12',
            'period'             => 'required',
            'contract'           => 'required',
            'habilitation'       => 'required',
            'modality_major'     => 'required',
            'course_type'        => 'required',
            'detail'             => 'nullable',
        ]);
     
        if($validator->fails())
        {    
            $error['message'] = $validator->errors();
            $error['error']   = true;

            return  $this->createResponse($error, 422);
        }

        //identificar qual ra esta faltando o dado, fazer o map das colunas e gravar na tabela, depois enviar para o totvs
        // dd($request->all());
        $data = new Request($discount);
        //dd($data);
        $this->store($data);
        // // $schoolarship = $this->store($data);
        // dd($data);
    }

  }






}
