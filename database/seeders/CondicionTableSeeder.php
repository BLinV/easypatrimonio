<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CondicionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('condicion')->insert([
            ['Descripcion'=>'Contratado'],
            ['Descripcion'=>'No Titular'],
            ['Descripcion'=>'Titular'],
            ['Descripcion'=>'Practicante']
        ]);
    }
}
