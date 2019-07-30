<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ImportBolsas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:bolsas {filename} {codcurso}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = '3 - Graduacao , 4 - Pos .... Faz importacao das bolsas passando nome do arquivo/ utilize "import:bolsas clear" para limpar todas ,';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */   
    public function handle()
    {
        
        $row = 0;
        $insert = [[]];
        $fileName = $this->argument('filename');
        $codCurso = $this->argument('codcurso');
        if(!$fileName || !$codCurso){
            echo "Digite o nome do arquivo e do codcurso";
            return;
        }
        if($fileName == 'clear'){
            echo 'Limpando as bolsas';
            DB::table('discount_margin_schoolarships')->truncate();
            return;
        }
        echo 'Importando bolsas\n';
        if (($fp = fopen("./app/Console/Commands/".$fileName, "r")) !== FALSE) {
            $data = fgetcsv($fp, 0, ";");  // lendo os headers
            while (($data = fgetcsv($fp, 0, ";")) !== FALSE) {
                if ($data[9] != '') {
                    $data = array_map("utf8_encode", $data);
                    $insert[$row]['id_rm_establishment_discount_margin_schoolarship'] = $data[0];   // CODFILIAL              
                    // $insert[$row]['id_rm_period_discount_margin_schoolarship'] = $data[1];    // FILIAL
                    $insert[$row]['id_rm_period_discount_margin_schoolarship'] = $data[2];    // IDPERLET
                    $insert[$row]['id_rm_period_code_discount_margin_schoolarship'] = $data[3];   // PERIODO_LETIVO 
                    $insert[$row]['id_rm_schoolarship_discount_margin_schoolarship'] = $data[4];  // CODBOLSA
                    $insert[$row]['id_rm_schoolarship_name_discount_margin_schoolarship'] = $data[5]; // BOLSA                      
                    $insert[$row]['id_rm_major_discount_margin_schoolarship'] = $data[6]; // CODCURSO  
                    // $insert[$row][''] = $data[7]; // CURSO
                    $insert[$row]['id_rm_modality_discount_margin_schoolarship'] = $data[8] == 'Presencial' ? 'P' : 'D'; //MODALIDADE
                    $insert[$row]['max_value_discount_margin_schoolarship'] = $data[9]; //PERCENTUAL
                    $insert[$row]['is_exact_value_discount_margin_schoolarship'] = $data[10]; //FIXO_MAX
                    $insert[$row]['first_installment_discount_margin_schoolarship'] = $data[11]; //PARCELA_INICIAL
                    $insert[$row]['last_installment_discount_margin_schoolarship'] = $data[12]; //PARCELA_FINAL
                    $insert[$row]['fk_user'] = '1';
                    $insert[$row]['id_rm_course_type_discount_margin_schoolarship'] = $codCurso;

                    $row++;
                }
            }
            fclose($fp);
        }
        foreach (array_chunk($insert,1000) as $t) {
            DB::table('discount_margin_schoolarships')->insert($t);
        }

    }
}
