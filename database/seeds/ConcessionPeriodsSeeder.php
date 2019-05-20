<?php

use Illuminate\Database\Seeder;

class ConcessionPeriodsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('concession_periods')->insert([
            'id_rm_establishment_concession_period'=> 169,
            'id_rm_modality_concession_period' => 'P',
            'id_rm_period_concession_period' => 20,
            'id_rm_period_code_concession_period' => '2019-1',
            'date_start_concession_period' => '2019-01-01',
            'date_end_concession_period' => '2019-06-06',
            'fk_user' => 1
        ]);
        DB::table('concession_periods')->insert([
            'id_rm_establishment_concession_period'=> 169,
            'id_rm_modality_concession_period' => 'D',
            'id_rm_period_concession_period' => 2396,
            'id_rm_period_code_concession_period' => '2019-12',
            'date_start_concession_period' => '2019-01-01',
            'date_end_concession_period' => '2019-06-06',
            'fk_user' => 1
        ]);
    }
}
