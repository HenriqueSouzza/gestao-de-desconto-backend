<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;

class ImportPeriodos extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:periodos {filename : nome do arquivo} ';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Faz importacao dos periodos de concessao';

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
        echo 'Importando Periodos<br/>\n';
        if (($fp = fopen("./app/Console/Commands/".$fileName, "r")) !== FALSE) {
            $data = fgetcsv($fp, 0, ";");  // lendo os headers
            while (($data = fgetcsv($fp, 0, ";")) !== FALSE) {                
                $data = array_map("utf8_encode", $data);
                $insert[$row]['id_rm_establishment_concession_period'] = $data[0];   // CODFILIAL              
                // $insert[$row][''] = $data[1];    // FILIAL
                $insert[$row]['id_rm_period_concession_period'] = $data[2];    // IDPERLET
                $insert[$row]['id_rm_period_code_concession_period'] = $data[3];   // PERIODO_LETIVO 
                $insert[$row]['date_start_concession_period'] = $data[4];  // DTINICIAL
                $insert[$row]['date_end_concession_period'] = $data[5]; // DTFIM                      
                $insert[$row]['id_rm_modality_concession_period'] = $data[6]; // Modalideade  
                $insert[$row]['id_rm_course_type_concession_period'] = $data[7]; // CODCURSO                                       
                $insert[$row]['fk_user'] = '1';
                $row++;            
            }
            fclose($fp);
        }
        foreach (array_chunk($insert,1000) as $t) {
            DB::table('concession_periods')->insert($t);
        }

    }
}
