<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
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
