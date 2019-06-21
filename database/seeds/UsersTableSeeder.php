<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $users = [
            [
                'name' =>  'Caio Oliveira',
                'email' => 'caio.oliveira@cnec.br',
            ],
            [
                'name' =>  'Henrique Souza',
                'email' => 'henrique.souza@cnec.br',
            ],
            [
                'name' =>  'Renata Ferreira',
                'email' => 'renata.ferreira@cnec.br'
            ],
            [
                'name' =>  'Caio Alencar',
                'email' => 'caio.alencar@cnec.br'
            ],
            [
                'name' =>  'Shirley Melo',
                'email' => 'shirley.melo@cnec.br'
            ],
            [
                'name' =>  'Paulo Santana',
                'email' => 'paulo.santana@cnec.br'
            ],
            [
                'name' =>  'Thaline Pereira',
                'email' => 'thaline.pereira@cnec.br'
            ],

            [
                'name' => 'Ana Virgina Santos Ribeiro',
                'email' => '0106.anaribeiro@cnec.br'
            ],
            [
                'name' => 'Nivea Mag Carvalho Viana',
                'email' => '0106.niveaviana@cnec.br'
            ],
            [
                'name' => 'ADRIANO EGIDIO CLINI',
                'email' => '0415.adrianoclini@cnec.br'
            ],
            [
                'name' => 'CILENE BIANCONI DA SILVA CLINI',
                'email' => '0415.cileneclini@cnec.br'
            ],
            [
                'name' => 'CARLA REGINA ALVES METZGER',
                'email' => '0633.carlametzger@cnec.br'
            ],
            [
                'name' => 'DHYESSICA CAIRUS',
                'email' => 'dhyessikadasilva@hotmail.com'
            ],
            [
                'name' => 'VAGNER DOS SANTOS HAMPE',
                'email' => '0633.wagnerhampe@cnec.br'
            ],
            [
                'name' => 'Cassia Mirlania Soares Santos',
                'email' => '0353.cassiasoares@cnec.br'
            ],
            [
                'name' => 'Carla Stefania Silveira Carneiro',
                'email' => '0647.carlosalexandre@cnec.br'
            ],
            [
                'name' => 'Liane Teresinha Machado Guimarâes',
                'email' => '0647.lianeguimaraes@cnec.br'
            ],
            [
                'name' => 'LUCIANE ODIA',
                'email' => '2020.secretaria@cnec.br'
            ],
            [
                'name' => 'Lorenzo Dihl Sá',
                'email' => '0019.lorenzodihl@cnec.br'
            ],
            [
                'name' => 'ALEX LUIZ FERNANDES',
                'email' => '0039.alexfernandes@cnec.br'
            ],
            [
                'name' => 'DOLORES DOS SANTOS MEDEIROS',
                'email' => '0039.doloresmedeiros@cnec.br'
            ],
            [
                'name' => 'SANDRA REGINA MARTINS DA CONCEICAO',
                'email' => '0039.sandraconceicao@cnec.br'
            ],
            [
                'name' => 'VIVIANE MACHADO DE CARVALHO',
                'email' => '0039.vivianecarvalho@cnec.br'
            ],
            [
                'name' => 'Gilda Maria de Araújo Barcellos Salim',
                'email' => '2023.direcao@cnec.br'
            ],
            [
                'name' => 'Tuyane Soares da Silva',
                'email' => '2023.tuyanesilva@cnec.br'
            ],
            [
                'name' => 'ANA PAULA FEITOZA DE BARROS',
                'email' => '0346.anabarros@cnec.br'
            ],
            [
                'name' => 'GLEICE KELLY SILVA LEAL',
                'email' => '0346.gleiceleal@cnec.br'
            ],
            [
                'name' => 'MIKAELA MYLENA PEREIRA DA SILVA FEO',
                'email' => '0346.mikaelamagalhaes@cnec.br'
            ],
            [
                'name' => 'NARAYANNA GONÇALVES MACEDO',
                'email' => '0346.narayannamacedo@cnec.br'
            ],
            [
                'name' => 'THAMARA QUINTANILHA DOS SANTOS',
                'email' => '0346.thamarasantos@cnec.br'
            ],
            [
                'name' => 'VANDERLEI DA CRUZ BARBOSA',
                'email' => '0346.vanderleibarbosa@cnec.br'
            ],
            [
                'name' => 'BRENDA HELLEN DAS NEVES OLIVEIRA',
                'email' => '0350.brendaoliveira@cnec.br'
            ],
            [
                'name' => 'FERNANDA RANGEL FERREIRA BARBOSA',
                'email' => '0350.fernandabarbosa@cnec.br'
            ],
            [
                'name' => 'Keila Regina Medis Oliveira',
                'email' => '1916.keilamedis@cnec.br'
            ],
            [
                'name' => 'Luana Christina de Oliveira Silva',
                'email' => '1916.luanaoliveira@cnec.br'
            ],
            [
                'name' => 'MONICK ELLEN NOVAIS REIS',
                'email' => '1916.monickreis@cnec.br'
            ],
            [
                'name' => 'NAYARA ELLEN JUVENTINO',
                'email' => '1916.nayaraellen@cnec.br'
            ],
            [
                'name' => 'SERGIO FRANK CARVALHO',
                'email' => '1916.sergiocarvalho@cnec.br'
            ],
            [
                'name' => 'JENNIFER FRANCIELLI DOS SANTOS',
                'email' => 'ceadcoord.itajai@cnec.br'
            ],
            [
                'name' => 'Marcia Emilia de Azevedo Machado Fravoline',
                'email' => '1075.direcao@cnec.br'
            ],
            [
                'name' => 'Iury Fagundes da Silva',
                'email' => 'cead.iurysilva@cnec.br'
            ],
            [
                'name' => 'Julio Cesar de Oliveira Souza',
                'email' => '1075.juliosouza@cnec.br'
            ],
            [
                'name' => 'Andréa Moura',
                'email' => '0695.direcao@cnec.br'
            ],
            [
                'name' => 'Samile Pizzi',
                'email' => '0695.samilepizzi@cnec.br'
            ],
            [
                'name' => 'Moises Pedrozo Dias',
                'email' => '1110.moisesdias@cnec.br'
            ],
            [
                'name' => 'ROSANA PERES DOS SANTOS',
                'email' => '0527.rosanaperes@cnec.br'
            ],
            [
                'name' => 'VANDA MARIA DE CARVALHO DO ESPÍRITO SANTO',
                'email' => 'ceadcoord.pirapora@cnec.br'
            ],
            [
                'name' => 'PAULA TATIANE VIEIRA SILVA',
                'email' => '0439.paulasilva@cnec.br'
            ],
            [
                'name' => 'ADRIANE RIBEIRO LEITE',
                'email' => 'cead.adrianeleite@cnec.br'
            ],
            [
                'name' => 'ANDRESSA JULIANA BERTOJA BÜLOW',
                'email' => '0049.andressabulow@cnec.br'
            ],
            [
                'name' => 'KELLY FRANCINE AGE KUBRUSLY',
                'email' => '0049.gruposecretaria@cnec.br'
            ],
            [
                'name' => 'FABIANA APARECIDA MAZUR',
                'email' => '0774.fabianamazur@cnec.br'
            ],
            [
                'name' => 'ROSELI APARECIDA DE SOUZA DA SILVA',
                'email' => '0774.roselisilva@cnec.br'
            ],
            [
                'name' => 'VANDERLEI MIGUEL KRAEMER',
                'email' => '0681.vanderleikraemer@cnec.br'
            ],
            [
                'name' => 'Ana Paula Kreisig',
                'email' => '0662.anakreisig@cnec.br'
            ],
            [
                'name' => 'Ângela Wentz',
                'email' => '0662.angelawentz@cnec.br'
            ],
            [
                'name' => 'ALEX PRIMO BRUSTOLIN',
                'email' => '1869.alexprimo@cnec.br'
            ],
            [
                'name' => 'Rosane Da-Fré',
                'email' => '1869.rosanedafre@cnec.br'
            ],
            [
                'name' => 'ALEXANDRE CARNEIRO ARAÚJO - Ass Administrativo',
                'email' => '0262.alexandre@cnec.br'
            ],
            [
                'name' => 'ALYSON SOARES BENEVIDES - Diretor',
                'email' => '0262.alysonbenevides@cnec.br'
            ],
            [
                'name' => 'YANE TEIXEIRA RODRIGUES - Coor de Polo EAD',
                'email' => '0262.yanerodrigues@cnec.br'
            ],
            [
                'name' => 'Francisca Arruda Ramalho',
                'email' => '1746.franciscaramalho@cnec.br'
            ],
            [
                'name' => 'Maria Aparecida Galdino Arruda',
                'email' => '1746.mariagaldino@cnec.br'
            ],
            [
                'name' => 'Patrícia dos Santos Araújo',
                'email' => 'ceadcoord.joaopessoageisel@cnec.br'
            ],
            [
                'name' => 'Maria de Fátima Pontes dos Santos',
                'email' => '0214.marialima@cnec.br'
            ],
            [
                'name' => 'Sonia Maria Gouveia da Silva',
                'email' => '0214.soniasilva@cnec.br'
            ],
            [
                'name' => 'KARLA TAYNÁ AMARANTE TATIM',
                'email' => 'cead.karlatatim@cnec.br'
            ],
            [
                'name' => 'FRANCISCO EDVANDO VASCONCELOS',
                'email' => '0271.franciscovasconcelos@cnec.br'
            ],
            [
                'name' => 'Andrei Vinicius Roque dos Santos',
                'email' => '1071.andreisantos@cnec.br'
            ],
            [
                'name' => 'FRANCISCA DE FÁTIMA BESSA MADEIRA',
                'email' => '0274.franciscamadeira@cnec.br'
            ],
            [
                'name' => 'MARCELO WESLEY NOVAIS',
                'email' => '0274.marcelonovais@cnec.br'
            ],
            [
                'name' => 'ANA SILMARIA DE OLIVEIRA LIMA',
                'email' => 'silmarialima08@gmail.com'
            ],
            [
                'name' => 'Luciana da Silva Lamb',
                'email' => '0662.lucianalamb@cnec.br'
            ],
            [
                'name' => 'Isabel Elena Schmitt Montemezzo',
                'email' => '2015.marilainesouza@cnec.br'
            ],
            [
                'name' => 'Maria Ivanete Moraes de Araújo',
                'email' => '0296.direcao@cnec.br'
            ],
            [
                'name' => 'Nilcilene Marinho de Souza',
                'email' => '0296.nilcilenesouza@cnec.br'
            ],
            [
                'name' => 'Etelvina Maria do Nascimento',
                'email' => '0944.direcao@cnec.br'
            ],
            [
                'name' => 'Elizângela Vieira Gonçalves',
                'email' => '0944.elizangelagoncalves@cnec.br'
            ],
            [
                'name' => 'Maria Eurimar de Sousa Lacerda',
                'email' => '0944.marialacerda@cnec.br'
            ],
            [
                'name' => 'Heven Caroline Paulino de Oliveira Viana',
                'email' => 'cead.hevenviana@cnec.br'
            ],
            [
                'name' => 'ERICA PESSOA DO MONTE',
                'email' => 'cead.ericapessoa@cnec.br'
            ],
            [
                'name' => 'DARIO TAVARES DA SILVA',
                'email' => '0912.dariotavares@cnec.br'
            ],
            [
                'name' => 'Amália Maria Zamarrenho Bruno',
                'email' => '1809.amaliabruno@cnec.br'
            ],
            [
                'name' => 'Glenda César da Silva Oliveira',
                'email' => '1809.glendacesar@cnec.br'
            ],
            [
                'name' => 'Karini Campos Nascimento',
                'email' => '1809.karinicampos@cnec.br'
            ],
            [
                'name' => 'José Hipólito de Araújo Alves',
                'email' => 'cead.josealves@cnec.br'
            ],
            [
                'name' => 'Maria Eliane dos Santos Lima',
                'email' => '0060.marialima@cnec.br'
            ],
            [
                'name' => 'Joabe da Silva Pereira',
                'email' => 'cead.joabepereira@cnec.br'
            ],
            [
                'name' => 'MARIA CRISTINA MATZEMBACHER SOARES',
                'email' => '0633.mariasoares@cnec.br'
            ],
            [
                'name' => 'GABRIELA REGINA GASPARINI',
                'email' => '0950.gabrielagasparini@cnec.br'
            ],
            [
                'name' => 'Cleonice Pinheiro de Olivieira',
                'email' => '0256.cleoniceoliveira@cnec.br'
            ],
            [
                'name' => 'Iris Cristina de Lima',
                'email' => '0256.iriscristina@cnec.br'
            ],
            [
                'name' => 'Renata Gomes de Araujo',
                'email' => '0256.renataaraujo@cnec.br'
            ],
            [
                'name' => 'Adriana Payão Ravache',
                'email' => '0137.adrianaravache@cnec.br'
            ],
            [
                'name' => 'Simone Nakatsukasa Venâncio',
                'email' => '0137.secretaria@cnec.br'
            ],
            [
                'name' => 'IVANETE DE ANDRADE SOUZA',
                'email' => '0981.ivanetesouza@cnec.br'
            ],
            [
                'name' => 'Carolina Girardi',
                'email' => '2018.carolinagirardi@cnec.br'
            ],
            [
                'name' => 'Maria Luzia Lasmar Correia',
                'email' => '2018.mariacorreia@cnec.br'
            ],
            [
                'name' => 'Luciene Sousa e Silva',
                'email' => 'ceadcoord.novamutum@cnec.br'
            ],
            [
                'name' => 'Susete Teresinha Toss Wartha',
                'email' => '0044.contato@cnec.br'
            ],
            [
                'name' => 'Patrícia Werle Stuermer',
                'email' => '0044.patriciastuermer@cnec.br'
            ],
            [
                'name' => 'Fernando Malheiros dos Santos Junior',
                'email' => '0044.fernandomalheiros@cnec.br'
            ],
            [
                'name' => 'ALIOMAR BERNARDO E SILVA FILHO',
                'email' => 'cead.aliomarfilho@cnec.br'
            ],
            [
                'name' => 'Glaucia Maria Rodrigues dos Santos',
                'email' => '0288.glauciasantos@cnec.br'
            ],
            [
                'name' => 'Leonel Ique Oliveira Rodrigues',
                'email' => '0288.leonelrodrigues@cnec.br'
            ],
            [
                'name' => 'Veridiano Rodrigues de Oliveira',
                'email' => '0288.veridianorodrigues@cnec.br'
            ],
            [
                'name' => 'Maria Silvana Macedo Morais',
                'email' => '0289.mariamorais@cnec.br'
            ],
            [
                'name' => 'Rosangela Maria Alves Milhome',
                'email' => '0289.rosangelamilhone@cnec.br'
            ],
            [
                'name' => 'Wanderley da Costa Oliveira',
                'email' => '0289.wanderleyoliveira@cnec.br'
            ],
            [
                'name' => 'JANINE LIMANA BACK',
                'email' => '1432.janineback@cnec.br'
            ],
            [
                'name' => 'MARGARIDA BEZERRA DA SILVA',
                'email' => '1432.secretaria@cnec.br'
            ],
            [
                'name' => 'ADRIANA DA COSTA MACHADO',
                'email' => 'ceadcoord.santoangelo@cnec.br'
            ],
            [
                'name' => 'Emily Oliveira e Silva',
                'email' => '1301.emilysilva@cnec.br'
            ],
            [
                'name' => 'Tatiana Barboza Rocha',
                'email' => '1163.direcao@cnec.br'
            ],
            [
                'name' => 'Alessandra Cosme Medeiros de Brito',
                'email' => 'alessandrabrito1000@gmail.com'
            ],
            [
                'name' => 'MARIA JOSÉ NUNES DE CARVALHO NEVES',
                'email' => '2001.marianeves@cnec.br'
            ],
            [
                'name' => 'POLLYANNA LEAL NASCIMENTO',
                'email' => '2001.pollyannanascimento@cnec.br'
            ],
            [
                'name' => 'RENATA ANDREA OLIVEIRA DA SILVA',
                'email' => 'renatasilva@cnec.br'
            ],
            [
                'name' => 'Helen Silva Sales',
                'email' => '2009.helensales@cnec.br'
            ],
            [
                'name' => 'Flário Saores Rocha',
                'email' => 'flaviosoaresrocha@outlook.com'
            ],
            [
                'name' => 'Raquel Silva Chagas Rodrigues',
                'email' => '1064.raquelrodrigues@cnec.br'
            ],
            [
                'name' => 'Maycon de Jesus Ramos',
                'email' => 'ceadcoord.quissama@cnec.br'
            ],
            [
                'name' => 'Maria Josélia Fernandes Gouveia',
                'email' => '1921.direcao@cnec.br'
            ],
            [
                'name' => 'Patrícia da Silva Tomé de Souza',
                'email' => '1921.patriciasouza@cnec.br'
            ],
            [
                'name' => 'Maria do Socorro Gouveia Oliveira',
                'email' => 'maria.oliveira@cnec.br'
            ],
            [
                'name' => 'KELLY CAVALCANTE MELO',
                'email' => '0090.kellymelo@cnec.br'
            ],
            [
                'name' => 'MYRLA DE LEMOS FONTES',
                'email' => '0090.myrlafontes@cnec.br'
            ],
            [
                'name' => 'Dayane de Souza Sales',
                'email' => '1158.direcao@cnec.br'
            ],
            [
                'name' => 'Myrela Santos de Carvalho',
                'email' => '1158.myrelacarvalho@cnec.br'
            ],
            [
                'name' => 'Sandra Regina Ribeiro Montimór',
                'email' => 'sandra@cnec.br'
            ],
            [
                'name' => 'IGOR DE ARAUJO ALVES',
                'email' => '0016.igoralves@cnec.br'
            ],
            [
                'name' => 'RAFAELA PEREIRA FERNANDES',
                'email' => '0016.rafaelafernandes@cnec.br'
            ],
            [
                'name' => 'MARCIO FRANCISCO ALVES',
                'email' => '0016.secretaria@cnec.br'
            ],
            [
                'name' => 'Aline Eidelwein',
                'email' => '0643.alineeidelwein@cnec.br'
            ],
            [
                'name' => 'Maria Isabel dos Santos Marques',
                'email' => '0643.mariasantos@cnec.br'
            ],
            [
                'name' => 'Marciene Laurinda Ferreira',
                'email' => '0355.secretaria@cnec.br'
            ],
            [
                'name' => 'Marcelo Adriano Piantkoski',
                'email' => '0574.marceloadriano@cnec.br'
            ],
            [
                'name' => 'Paulo Henrique Martins de Souza',
                'email' => 'PAULO@CNEC.BR'
            ]

        ];
        foreach ($users as &$user) {
            $user['password'] = '$2y$10$O8pBxNUdpAxY/9lz90G6UOTE3fXRFNxPhwe9YJooSZ94omIwlAQqC';
        }
        DB::table('users')->insert($users);

        $users = User::all();

        foreach ($users as $user) {
            $user->roles()->attach(1);
        }
    }
}
