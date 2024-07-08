<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngresoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('ingreso')->insert([
            ['NumeroPecosa' => '1234567890ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'IdOrigen' => 2, 'IdPersonal' => 1],
            ['NumeroPecosa' => '2234567890ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'IdOrigen' => 3, 'IdPersonal' => 1]
        ]);
        DB::Table('ingreso')->insert([
            ['NumeroPecosa' => '3234567890ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'IdOrigen' => 1, 'Observacion' => 'Palet completo', 'IdPersonal' => 1],
            ['NumeroPecosa' => '4234567890ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'IdOrigen' => 3, 'Observacion' => 'Palet dañado', 'IdPersonal' => 1],
            ['NumeroPecosa' => '5234567890ABCDEFGHIJ', 'Fecha' => Carbon::now(), 'IdOrigen' => 2, 'Observacion' => 'Palet incompleto', 'IdPersonal' => 1]
        ]);
    }
}
