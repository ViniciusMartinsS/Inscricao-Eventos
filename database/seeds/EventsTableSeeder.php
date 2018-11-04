<?php

use Illuminate\Database\Seeder;
use App\Models\Event;

class EventsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	Event::create([
    		'name' => '30º Semana da Educação de Santos',
    		'description' => 'As ATIVIDADES PROPOSTAS serão guiadas por oito eixos temáticos que dialogam com o tema central para favorecer às discussões. Os eixos temáticos surgem a partir dos oito indicadores de qualidades que norteiam o Projeto Político Pedagógico da Secretaria de Educação e Unidades Municipais de Educação',
    		'beginning_date' => '2018-12-01',
    		'end_date' => '2018-12-08'
    	]);
    }
}
