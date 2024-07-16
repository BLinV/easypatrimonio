<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaTableSeeder extends Seeder
{
    public function run()
    {
        DB::Table('categoria')->insert([
            ['Descripcion'=>'Computadoras'],
            ['Descripcion'=>'Refrigeración'],
            ['Descripcion'=>'Mobiliario'],
            ['Descripcion'=>'Instrumentos Médicos']
        ]);
    }
}
