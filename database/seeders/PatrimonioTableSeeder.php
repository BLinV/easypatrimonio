<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PatrimonioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('patrimonio')->insert([
            ['IdTipo'=> 1, 'Modelo' => '1800px', 'IdMarca' => 1, 'IdCategoria' => 1],
            ['IdTipo'=> 2, 'Modelo' => 'Intel Core TM i5 8Gb 512Gb SSD Ideacentre AIO 3 12° Gen 23.8', 'IdMarca' => 5, 'IdCategoria' => 1],
            ['IdTipo'=> 3, 'Modelo' => 'Prosphyg 760', 'IdMarca' => 3, 'IdCategoria' => 4],
            ['IdTipo'=> 4, 'Modelo' => 'Adscope', 'IdMarca' => 3, 'IdCategoria' => 4],
            ['IdTipo'=> 5, 'Modelo' => 'SPO2 de 8 pies para adultos de 8 pies', 'IdMarca' => 3, 'IdCategoria' => 4],
            ['IdTipo'=> 6, 'Modelo' => 'HR digital', 'IdMarca' => 4, 'IdCategoria' => 4]
        ]);
    }
}
