<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MarcaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('marca')->insert([
            ['Descripcion'=>'HP'],
            ['Descripcion'=>'ACER'],
            ['Descripcion'=>'ADC American Diagnostic Corporation'],
            ['Descripcion'=>'Adesco'],
            ['Descripcion'=>'Lenovo']
        ]);
    }
}
