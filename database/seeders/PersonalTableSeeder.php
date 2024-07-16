<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalTableSeeder extends Seeder
{
    public function run()
    {
        $fecha = Carbon::now();
        $fecha->setTimezone('America/Lima');
        DB::Table('personal')->insert([
            ['Nombres'=>'MARIO HUGO', 'Apellidos' => 'LEON TORRES', 'Dni' => '12345678', 'Celular' => '123456789', 'IdCondicion' => 1, 'IdServicio' => 1, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Nombres'=>'MERCEDES MARIA', 'Apellidos' => 'LÓPEZ GONZÁLEZ', 'Dni' => '22345678', 'Celular' => '123456789', 'IdCondicion' => 2, 'IdServicio' => 2, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Nombres'=>'LENIN EDUARDO', 'Apellidos' => 'SAGUAY SANAGUANO', 'Dni' => '32345678', 'Celular' => '123456789', 'IdCondicion' => 3, 'IdServicio' => 1, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Nombres'=>'AZUAY GONZALO', 'Apellidos' => 'BALCAZAR CAMPOVERDE', 'Dni' => '42345678', 'Celular' => '123456789', 'IdCondicion' => 4, 'IdServicio' => 4, 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Nombres'=>'BOLÍVAR DANILO FERNANDO', 'Apellidos' => 'GARCÍA GARCÍA', 'Dni' => '52345678', 'Celular' => '123456789', 'IdCondicion' => 2, 'IdServicio' => 1, 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
    }
}
