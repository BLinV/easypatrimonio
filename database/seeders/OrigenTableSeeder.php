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
            ['Descripcion'=>'UTES - RDR - RECURSOS DIRECTAMENTE RECAUDADOS'],
            ['Descripcion'=>'UTES - RO - RECURSOS ORDINARIOS'],
            ['Descripcion'=>'UTES - DIT - DONACIONES Y TRANSFERENCIAS'],
            ['Descripcion'=>'OTRO - [CAJA CHICA, DONACIONES, ETC]']
        ]);
    }
}
