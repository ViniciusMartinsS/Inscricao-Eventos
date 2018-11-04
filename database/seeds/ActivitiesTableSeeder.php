<?php

use Illuminate\Database\Seeder;
use App\Models\Activity;

class ActivitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Activity::create([
            'name' =>  'Aprendendo Java',
            'description' =>  'Você irá aprender conceitos básicos da linguagem Java',
            'beginning_datetime' =>  '2018-12-01 13:00:00',
            'end_datetime' =>  '2018-12-01 17:00:00',
            'minimum_quorum' =>  '0',
            'maximum_capacity' =>  '30',
            'place' =>  'Av. Bartolomeu de Gusmão, 110 - Aparecida, Santos - SP',
            'event_id' =>  '1'
        ]);
    }
}
