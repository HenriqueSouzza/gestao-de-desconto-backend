<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Validator;

use App\Http\Controllers\Api\ApiControllerTrait;

use App\Models\SchoolarshipWorkflow;
use App\Models\StudentSchoolarship;

use App\TotvsTraits\TotvsQuerySqlTrait;

use App\TotvsTraits\TotvsSaveRecordTrait;
use App\Models\DiscountMarginSchoolarship;

class StudentSchoolarShipController extends Controller
{
    /**
     * <b>use ApiControllerTrait</b> Usa a trait e sobreescreve os seus nomes e sua visibilidade, para a classe
     * que esta utilizando a mesma. Sendo assim temos um método index neste classe e um na ApiControllerTrait. 
     * Para não causar conflito é alterado o seu nome exemplo: index as protected indexTrait;
     * Mais informações em: http://php.net/manual/en/language.oop5.traits.php (Changing Method Visibility)
     */
    use ApiControllerTrait {

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
     * <b>use TotvsSaveRecordTrait</b>
     */
    use TotvsSaveRecordTrait;

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
        //dd($request->all());
        return $this->storeTrait($request);
        // dd($schoolarship);
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

    /**
     * <b>getLocalSchoolarships</b> Método responsável por obter as bolsas que não foram enviadas ao RM(TOTVS) e que foram concedidas a uma determinada filial e periodo letivo
     * @param Request $request
     * @return $this->model(array)
     */
    public function getLocalSchoolarships(Request $request)
    {
        // return StudentSchoolarship::where([
        //     'id_rm_establishment_student_schoolarship' => $request->codfilial, 
        //     'id_rm_period_code_student_schoolarship' => $request->codperlet,
        //     'send_rm_student_schoolarship' => false
        // ])->get()->toArray(); 

        return $this->model->where([
            'id_rm_establishment_student_schoolarship' => $request->codfilial,
            'id_rm_period_code_student_schoolarship'   => $request->codperlet,            
            'send_rm_student_schoolarship'             => false
        ])
        ->whereNull('id_rm_student_schoolarship')
        ->get()->toArray();
    }



    ///////////////////////////////////////////////////////////////////////
    ///////////////////// WEBSERVICE TOTVS SOAP METHODS ////////////////////
    ////////////////////////////////////////////////////////////////////////

    /**
     * <b>getStudents<b/> Método responsavel por obter os dados dos estudantes para isso devem ser informados os seguintes dados:
     * codfilial : 169,
     * codcurso : "GP006",
     * codpolo: "-1" 
     * codperlet : 2019-1,
     * ra : -1,
     * nomealuno : -1
     * OBS: Caso não possua um determinado dado para pesquisa informar -1
     * @param Request $request
     * @return method createResponse
     * 
     */
    protected function getStudents(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'codfilial' => 'required|numeric|min:1',
            'codcurso'  => 'required|string',
            'codpolo'   => 'required|string',
            'codperlet' => 'required',
            'ra'        => 'required|numeric',
            'nomealuno' => 'required|',
            'tipoaluno' => 'required|'
        ]);

        if ($validator->fails()) {
            $error['message'] = $validator->errors();
            $error['error']   = true;

            return  $this->createResponse($error, 422);
        }

        $name = self::$nameQuery['WEB006'];

        $parameters = [
            'CODFILIAL' => $request->codfilial,
            'CODCURSO'  => $request->codcurso,
            'CODPOLO'   => $request->codpolo,
            'CODPERLET' => $request->codperlet,
            'RA'        => $request->ra,
            'NOMEALUNO' => $request->nomealuno,
            'TIPOALUNO' => $request->tipoaluno
        ];

        $requestSoap = (array)$this->query($name, $parameters);

        $schoolarship       =  (array)$this->getSchoolarship($request);
        $tempLocals         =  (array)$this->getLocalSchoolarships($request);
        $localScholarships  =  $this->schoolarshipToKeyContract($tempLocals);
        $responseSoap = $this->formatResponse($requestSoap, $schoolarship, $localScholarships);
        return $this->createResponse($responseSoap);
    }

    /**
     * <b>getLocalStudents</b> Método responsável em obter as bolsas que foram concedidas "localmente" ou seja apenas na API e não foi 
     * enviada para o RM(TOTVS) 
     * @param Request $request;
     * @return method $this->createResponse
     */
    protected function getLocalStudents(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'codfilial' => 'required|numeric|min:1',
            'codcurso'  => 'required|string',
            'codpolo'   => 'required|string',
            'codperlet' => 'required',
            'ra'        => 'required|numeric',
            'nomealuno' => 'required|'
        ]);

        if ($validator->fails()) {
            $error['message'] = $validator->errors();
            $error['error']   = true;

            return  $this->createResponse($error, 422);
        }

        $name = self::$nameQuery['WEB006'];
        $parameters = $this->getStudentsParams($request);
        $requestSoap = (array)$this->query($name, $parameters);

        $schoolarship = $this->getSchoolarship($request);
        $tempLocals = $this->getLocalSchoolarships($request);
        $localScholarships = $this->schoolarshipToKeyContract($tempLocals);
        $responseSoap = $this->formatResponse($requestSoap, $schoolarship, $localScholarships);

        $localStudents = [];
        foreach ($responseSoap as $val) {
            if (sizeof($val['bolsas_locais'])) {
                array_push($localStudents, $val);
            }
        }
        return $this->createResponse($localStudents);
    }

    /**
     * <b>getStudentsParams</b> Método responsável em receber um objeto do tipo Request $request e retornar um array apartir desses dados
     * @param Request $request
     * @return array []
     */
    protected function getStudentsParams(Request $request)
    {
        return [
            'CODFILIAL' => $request->codfilial,
            'CODCURSO'  => $request->codcurso,
            'CODPOLO'   => $request->codpolo,
            'CODPERLET' => $request->codperlet,
            'RA'        => $request->ra,
            'NOMEALUNO' => $request->nomealuno
        ];
    }

    /**
     * <b>schoolarshipToKeyContract</b> Método responsável por receber um array com as bolsas e retornar um novo array estruturado 
     * @param  $scholarships
     * @return Array $newArray
     */
    protected function schoolarshipToKeyContract($scholarships)
    {
        $newArray = [];

        foreach ($scholarships as $scholarship) {
            $newArray[(string)$scholarship['id_rm_contract_student_schoolarship']] = $scholarship;
        }
        return $newArray;
    }


    /**
     * <b>formatResponse</b> Método responsável por trabalhar os dados de estudantes e de bolsas dos estudantes, separa as bolsas anteriores das
     * bolsas atuais e chamar o método printResponse e retornar o dado.
     * @param $dataStudent (dados dos estudantes)
     * @param $dataSchoolarship (dados das bolsas)
     * OBS: Ajuda a "mergiar" os dados tendo em vista que nos dados de bolsas  é retornado apenas o RA do aluno
     * @return $this->response;
     */
    protected function formatResponse($dataStudent, $dataSchoolarship, $localScholarships = [])
    {
        $beforeSchoolarship = [];
        $afterSchoolarship = [];
        $localScholarship = [];


        if (!isset($dataStudent['Resultado'])) {
            return $this->response;
        };
        //verifica se possui o indice resultado e se o mesmo é um array caso for veio mais de um resultado caso contrario veio apenas um se retornar 0 é porque não houve resultado
        $size = is_array($dataStudent['Resultado']) ? count($dataStudent['Resultado']) : 1;
        //caso so tenha um registro irá contar os objetos
        if ($size == 1) {
            $result = $dataStudent['Resultado'];
            $ra = (string)$result->RA;
            $contract = (string)$result->CODCONTRATO;

            //pesquisa se nas bolsas obtidas possui o RA do aluno 
            for ($i = 0; $i < count($dataSchoolarship); $i++) {
                $data = (array)$dataSchoolarship[$i];

                if (in_array($ra, $data)) {
                    //obtem as bolsas anteriores
                    if (in_array('ANTERIOR', $data)) {
                        $beforeSchoolarship[] = $data;
                    } else {
                        $afterSchoolarship[] = $data;
                    }
                }

                if (array_key_exists($contract, $localScholarships)) {
                    $localScholarship[$ra] = [$localScholarships[$contract]];
                }
            }

            $this->response[] = $this->printResponse($result, $beforeSchoolarship, $afterSchoolarship, $localScholarship);
        }
        //caso tenha mais de um aluno 

        if ($size > 1) {
            foreach ($dataStudent['Resultado'] as $result) {
                $check = false;
                $ra = (string)$result->RA;
                $contract = (string)$result->CODCONTRATO;
                //pesquisa se nas bolsas obtidas possui o RA do aluno 
                for ($i = 0; $i < count($dataSchoolarship); $i++) {

                    $data = (array)$dataSchoolarship[$i];
                    //verificar o que ele faz com os outros itens do array
                    if (in_array($ra, $data)) {
                        $check = true;
                        //obtem as bolsas anteriores
                        if (in_array('ANTERIOR', $data)) {
                            $beforeSchoolarship[$ra][] = $data;
                        } else {
                            $afterSchoolarship[$ra][] = $data;
                        }
                    }


                    if (array_key_exists($contract, $localScholarships)) {
                        $localScholarship[$ra] = [$localScholarships[$contract]];
                    }
                }

                if ($check) {
                    $before = (array_key_exists($ra, $beforeSchoolarship) ? $beforeSchoolarship[$ra] : []);
                    $after = (array_key_exists($ra, $afterSchoolarship) ? $afterSchoolarship[$ra] : []);
                    $local = (array_key_exists($ra, $localScholarship) ? $localScholarship[$ra] : []);
                    $this->response[] = $this->printResponse($result, $before, $after, $local);
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
            'codpolo'   => 'required|numeric',
            'codperlet' => 'required',
            'ra'        => 'required|numeric',
            'nomealuno' => 'required|'
        ]);

        if ($validator->fails()) {
            $error['message'] = $validator->errors();
            $error['error']   = true;

            return  $this->createResponse($error, 422);
        }

        $name = self::$nameQuery['WEB009'];

        $parameters = [
            'CODFILIAL' => $request->codfilial,
            'CODCURSO'  => $request->codcurso,
            'CODPOLO'   => $request->codpolo,
            'CODPERLET' => $request->codperlet,
            'RA'        => $request->ra,
            'NOMEALUNO' => $request->nomealuno
        ];

        $requestSoap = (array)$this->query($name, $parameters);
        return (isset($requestSoap['Resultado']) ? $requestSoap['Resultado'] : $requestSoap);
    }


    /**
     * <b>printResponse<b/> Método responsável por formatar a resposta no padrão desejado
     * @param $result (dados dos estudantes)
     * @param $beforeSchoolarship (bolsas anteriores)
     * @param $afterSchoolarship (bolsas atuais)
     */
    protected function printResponse($result, $beforeSchoolarship, $afterSchoolarship, $localScholarship)
    {
        return [
            'dados' => [
                'ra'                  => (string)$result->RA,
                'aluno'               => (string)$result->ALUNO,
                'codfilial'           => (string)$result->CODFILIAL,
                'filial'              => (string)$result->FILIAL,
                'codcurso'            => (string)$result->CODCURSO,
                'codContrato'         => (string)$result->CODCONTRATO,
                'idhabilitacaofilial' => (string)$result->IDHABILITACAOFILIAL,
                'curso'               => (string)$result->CURSO,
                'codperlet'           => (string)$result->CODPERLET,
                'idperlet'            => (string)$result->IDPERLET,
                'valor_mensalidade'   => (string)$result->VALOR_MENSALIDADE,
                'tipo_aluno'          => (string)$result->TIPO_ALUNO,
                'modalidade'          => (string)$result->MODALIDADE,
            ],
            'bolsas_anteriores'       => $beforeSchoolarship,
            'bolsas_atuais'           => $afterSchoolarship,
            'bolsas_locais'           => $this->formatToRMResponse($localScholarship)
        ];
    }


    /**
     * <b>formatToRMResponse</b>Tranforma nossa bolsa salva no banco no formato que vem do RM
     * @param Array  $schoolarships
     * @return Array $newArray
     */
    private function formatToRMResponse(array $schoolarships)
    {

        $newArray = [];
        $count = 0;
        $discounts = DiscountMarginSchoolarship::get();
        $names = [];
        foreach ($discounts as $discount) {
            $names[$discount->id_rm_schoolarship_discount_margin_schoolarship] = $discount->id_rm_schoolarship_name_discount_margin_schoolarship;
        }
        
        foreach ($schoolarships as $schoolarship) {
            // caso seja apenas uma bolsa
            if(!isset($schoolarship[$count])){
                $temp = [
                    'ID'              => $schoolarship['id_student_schoolarship'],
                    'RA'              => $schoolarship['ra_rm_student_schoolarship'],
                    'CODCONTRATO'     => $schoolarship['id_rm_contract_student_schoolarship'],
                    'IDPERLET'        => $schoolarship['id_rm_period_student_schoolarship'],
                    'CODPERLET'       => $schoolarship['id_rm_period_code_student_schoolarship'],
                    'BOLSA'           => $names[$schoolarship['id_rm_schoolarship_student_schoolarship']],
                    'CODBOLSA'        => $schoolarship['id_rm_schoolarship_student_schoolarship'],
                    'DESCONTO'        => $schoolarship['value_student_schoolarship'],
                    'PARCELAINICIAL'  => $schoolarship['first_installment_student_schoolarship'],
                    'PARCELAFINAL'    => $schoolarship['last_installment_student_schoolarship'],
                    'CONCESSAO'       => 'LOCAL'
                ];
                return [$temp];
            }
            // caso tenha varias bolsas locais
            $temp = [
                'RA'              => $schoolarship[$count]['ra_rm_student_schoolarship'],
                'CODCONTRATO'     => $schoolarship[$count]['id_rm_contract_student_schoolarship'],
                'IDPERLET'        => $schoolarship[$count]['id_rm_period_student_schoolarship'],
                'CODPERLET'       => $schoolarship[$count]['id_rm_period_code_student_schoolarship'],
                'BOLSA'           => $names[$schoolarship[$count]['id_rm_schoolarship_student_schoolarship']],
                'CODBOLSA'        => $schoolarship[$count]['id_rm_schoolarship_student_schoolarship'],
                'DESCONTO'        => $schoolarship[$count]['value_student_schoolarship'],
                'PARCELAINICIAL'  => $schoolarship[$count]['first_installment_student_schoolarship'],
                'PARCELAFINAL'    => $schoolarship[$count]['last_installment_student_schoolarship'],
                'CONCESSAO'       => 'LOCAL'
            ];
            array_push($newArray, $temp);
            $count++;
        
           
        }
        return $newArray;
    }
    public function getLog(){         
        return $this->createResponse(SchoolarshipWorkflow::all());
    }

    /**
     * <b>postSchoolarship</b> Método responsável por cadastrar as bolsas recebidas no banco de dados da API e envia 
     * a requisição para o Webservice (dataserver método SaveRecord). Para realizar esta ação recebe a requisição no seguinte formato:
     * 	"discounts" : {
     *   "0":{ (chave do json)
     *  	"ra" : "02112385", (matricula do aluno)
     *	"establishment" : 169, (filial/estabelecimento)
     *	"schoolarship" : "2", (bolsa)
     *	"schoolarship_order": "1", (ordem da bolsa)
     *	"value" : "25", (valor da bolsa)
     *	"first_installment" : 4,(parcela inicial)
     *	"last_installment": 4, (parcela final)
     *	"service" : 2, (codigo do serviço)
     *	"period" : "2272", (periodo letivo)
     *	"contract" : "393445", (codigo do contrato)
     *	"habilitation" : 2092, (id da habilitação)
     *	"modality_major" : 2, (código da modalidade)
     *	"course_type" : 3, (código do tipo de curso)
     *	"detail" : "boolsa", (detalhes da bolsa)
     *	"send_rm" : true, (se foi enviado ou não para o RM TOTVS)
     *	"active" : true (se a bolsa esta ativa ou não)
     *  }
     *
     * @param Request $request (com os dados acima no formato JSON)
     * @return array $requestSoap
     * }
     */
    protected function postSchoolarship(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'discounts' => 'required|array'
        ]);
        // 
        if ($validator->fails()) {
            $error['message'] = $validator->errors();
            $error['error']   = true;

            return  $this->createResponse($error, 422);
        }

        foreach ($request->discounts as $discount) {
            $validator = Validator::make($discount, [
                'ra'                   => 'required',
                'establishment'        => 'required',
                'schoolarship'         => 'required',
                'schoolarship_order'   => 'required',
                'student_schoolarship' => 'nullable|numeric',
                'value'                => 'required',
                'first_installment'    => 'required|numeric|min:1',
                'last_installment'     => 'required|numeric|max:12',
                'period'               => 'required',
                'period_code'          => 'required',
                'contract'             => 'required',
                'habilitation'         => 'required',
                'modality_major'       => 'required',
                'course_type'          => 'required',
                'detail'               => 'nullable',
            ]);

            if ($validator->fails()) {
                $error['message'] = $validator->errors();
                $error['error']   = true;

                return  $this->createResponse($error, 422);
            }

            //verificar se o contrato possui parcelas em abertos
            $installments = $this->getInstallmentContract($discount['first_installment'], $discount['last_installment'], $discount['contract']);

            if ((string)$installments->POSSUI_LANCAMENTO == 1) {
                $error = "O Contrato {$discount['contract']} possui parcelas geradas, não sendo possível lançar o desconto";
                $requestSoap[$discount['ra']][] = $discount;
                $requestSoap[$discount['ra']]['erro'] = $error;
            } else {

                //identificar qual ra esta faltando o dado, fazer o map das colunas e gravar na tabela, depois enviar para o totvs
                $data = new Request($discount);
                $discount = (Object)$discount;
                // dd($rule = $this->model->ruleDuplicateSchoolarship($discount->ra, $discount->contract, 
                //                         $discount->schoolarship, $discount->period, $discount->first_installment, $discount->last_installment));


                $update = isset($discount->id);

                $action = $update ? $this->update($data, $discount->id) : $this->store($data);

                if ($discount->send_rm) {   //caso passe o idbolsaaluno o registro irá ser atualizado se não sera criado
                    $studentSchoolarship = (isset($discount->student_schoolarship) ? $discount->student_schoolarship : 'xsi');
                    //dd($studentSchoolarship);
                    $dataServer = 'EduBolsaAlunoData';                   
                    if($discount->first_installment == 1){
                        $xmlRequestServico1 = [
                            'SBolsaAluno' => [
                                ['IDBOLSAALUNO'   => $studentSchoolarship],
                                ['CODCOLIGADA'    => 1],
                                ['PARCELAINICIAL' => '1'],
                                ['PARCELAFINAL'   => '1'],
                                ['RA'             => $discount->ra],
                                ['IDPERLET'       => $discount->period],
                                ['CODCONTRATO'    => $discount->contract],
                                ['CODBOLSA'       => $discount->schoolarship],
                                ['CODSERVICO'     => 1],
                                ['DESCONTO'       => $discount->value],
                                ['TIPODESC'       => 'P'],
                                ['CODUSUARIO'     => 'wsgestaodedesconto'],
                                ['ATIVA'          => 'S']
    
                            ],
                        ];
                        $result = (string)$this->saveRecord($dataServer, $xmlRequestServico1);
                        $search = (string)explode(':', $result)[1];                    
                        if (!strchr($search, ';')) {
                            $requestSoap[$discount->ra]['erro'] = "(E001) ERRO AO SALVAR NA PRIMEIRA PARCELA";                        
                            $id = $action->getData()->response->content->id;
                            $delete = $this->destroy($id);
                            $requestSoap[$discount->ra][] = $delete->getData()->response->content;
                            return $requestSoap;
                            
                        }
                        else{
                            $id = $action->getData()->response->content->id;                        
                            $discount->student_schoolarship = $studentSchoolarship;
                            $discount = (array)$discount;
                            $dataUpdate = new Request($discount);
                            $discount = (object)$discount;                            
                            $update = $this->update($dataUpdate, $id);    
                        }
                    }
                     
                    $xmlRequest = [
                        'SBolsaAluno' => [
                            ['IDBOLSAALUNO'   => $studentSchoolarship],
                            ['CODCOLIGADA'    => 1],
                            ['PARCELAINICIAL' => $discount->first_installment == '1' ? '2' : $discount->first_installment],
                            ['PARCELAFINAL'   => $discount->last_installment],
                            ['RA'             => $discount->ra],
                            ['IDPERLET'       => $discount->period],
                            ['CODCONTRATO'    => $discount->contract],
                            ['CODBOLSA'       => $discount->schoolarship],
                            ['CODSERVICO'     => 2],
                            ['DESCONTO'       => $discount->value],
                            ['TIPODESC'       => 'P'],
                            ['CODUSUARIO'     => 'wsgestaodedesconto'],
                            ['ATIVA'          => 'S']

                        ],
                    ];

                    $result = (string)$this->saveRecord($dataServer, $xmlRequest);
                    //separa a string em array tendo o denominador :
                    $search = (string)explode(':', $result)[1];
                    //faz busca na string caso não tenha os dois pontos significa que a resposta não foi 1;215456(CODCOLIGADA;IDSBOLSAALUNO)
                    if (!strchr($search, ';')) {
                        //separa a string em array tendo como demoninador \n faz isso para obter apenas a mensagem de erro
                        $error = explode('\n', $result);
                        $error = $error[0];
                        //faz o replace 
                        $error = str_replace('{"SaveRecordResult":', '', $error);
                        //array para converter os erros nos caracteres especiais da mensagem
                        $convert = ['\u00ed' => 'í', '\u00e7' => 'ç', '\u00e3' => 'ã', '\u00e9' => 'é'];
                        //substitui as notações pelos caracteres informados acima
                        $error = strtr($error, $convert);
                        //retira as aspas duplas da mensagem 
                        $error = str_replace('"', '', $error);
                        $requestSoap[$discount->ra]['erro'] = $error;
                        // SchoolarshipWorkflow::create(
                        //     [
                        //         'fk_student_schoolarship'      => $discount->id,
                        //         'fk_action'                    => 5, // tentativa de insercao
                        //         'fk_user'                      => $request->user, //TODO: Pegar id do usuario
                        //         'detail_schoolarship_workflow' => $error
                        //     ]
                        // );
                        //excluir o registro inserido por meio da API
                        $id = $action->getData()->response->content->id;
                        $delete = $this->destroy($id);
                        $requestSoap[$discount->ra][] = $delete->getData()->response->content;
                    } else {
                        //formata o idsbolaaluno recebido como resposta do webservice
                        $studentSchoolarship = explode(';', $search);
                        $studentSchoolarship = $studentSchoolarship[1];
                        $studentSchoolarship = str_replace('"', '', $studentSchoolarship);
                        $studentSchoolarship = str_replace('}', '', $studentSchoolarship);
                        //fazer o update do registro passando o id da bolsa aluno
                        $id = $action->getData()->response->content->id;
                        //adiciona o id da bolsa do aluno junto aos dados enviados
                        $discount->student_schoolarship = $studentSchoolarship;
                        $discount = (array)$discount;
                        $dataUpdate = new Request($discount);
                        $discount = (object)$discount;
                        //atualiza o registro inserido acima
                        $update = $this->update($dataUpdate, $id);                        
                        //obtem a resposta (API) por meio da classe jsonresponse por meio do getData()
                        $requestSoap[$discount->ra][] = $update->getData()->response->content;
                    }
                } else {
                    $id = $action->getData()->response->content->id;
                    SchoolarshipWorkflow::create(
                        [
                            'fk_student_schoolarship'      => $id,
                            'fk_action'                    => $update ? 2 : 1, // CRIACAO
                            'fk_user'                      => 1, //TODO: Pegar id do usuario
                            'detail_schoolarship_workflow' => 'exemplo'
                        ]
                    );

                    $requestSoap[$discount->ra][] = $action->getData()->response->content;
                }
            }
        }

        return $requestSoap;
    }

    /**
     * <b>getInstallmentContract</b> Método responsável por obter a resposta se o contrato, possui 
     * ou não parcela gerada em um determinado intervalo: exemplo: 1-6
     * @param int $firstInstallment (parcela inicial)
     * @param int $lastInstallment (parcela final)
     * @param int $contract (contrato)
     * @return array $requestSoap
     */
    protected function getInstallmentContract($firstInstallment, $lastInstallment, $contract)
    {
        $name = self::$nameQuery['WEB010'];

        $parameters = [
            'PARCELAINICIAL' => $firstInstallment,
            'PARCELAFINAL'   => $lastInstallment,
            'CODCONTRATO'    => $contract,
        ];

        $requestSoap = (array)$this->query($name, $parameters);
        return $requestSoap['Resultado'];
    }


    /**
     * <b>getProfitCourse</b> Método responsável por obter a receita de acordo com a filial, curso mes e ano informados
     * @param Request $request (filial, curso mes e ano)
     * @return Array $requestSoap
     */
    protected function getProfitCourse(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'codfilial' => 'required',
            'codcurso'  => 'required',
            'mes'       => 'required',
            'ano'       => 'required'
        ]);

        if ($validator->fails()) {
            $error['message'] = $validator->errors();
            $error['error']   = true;

            return  $this->createResponse($error, 422);
        }

        $name = self::$nameQuery['WEB007'];

        $parameters = [
            'CODFILIAL' => $request->codfilial,
            'CODCURSO'  => $request->codcurso,
            'MES_INICAL'       => $request->mes,
            'MES_FINAL'       => $request->mes,
            'ANO'       => $request->ano
        ];

        $requestSoap = (array)$this->query($name, $parameters);

        return $this->createResponse($requestSoap['Resultado']);
    }
}
