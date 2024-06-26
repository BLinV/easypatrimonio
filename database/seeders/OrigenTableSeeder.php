<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class OrigenTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('origen')->insert([
            ['Descripcion'=>'UTES'],
            ['Descripcion'=>'CAJA CHICA'],
            ['Descripcion'=>'DONACIONES'],
            ['Descripcion'=>'OTROS']
        ]);
    }
}
