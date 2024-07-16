<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TipoTableSeeder extends Seeder
{
    public function run()
    {
        DB::Table('tipo')->insert([
            ['Descripcion'=>'Monitor'],
            ['Descripcion'=>'All in One'],
            ['Descripcion'=>'Esfigmomanómetro aneroide'],
            ['Descripcion'=>'Estetoscopio'],
            ['Descripcion'=>'Sensor de dedo'],
            ['Descripcion'=>'Proscopio']
        ]);
    }
}
