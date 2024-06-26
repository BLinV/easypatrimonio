<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PersonalTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('personal')->insert([
            ['Nombres'=>'HELEN LISET', 'Apellidos' => 'HARO SALDAÑA', 'Dni' => '18161616', 'Celular' => '949977777', 'IdCondicion' => 1, 'IdServicio' => 29],
            ['Nombres'=>'MARIO HUGO', 'Apellidos' => 'LEON TORRES', 'Dni' => '12345678', 'Celular' => '123456789', 'IdCondicion' => 1, 'IdServicio' => 1],
            ['Nombres'=>'MERCEDES MARIA', 'Apellidos' => 'LÓPEZ GONZÁLEZ', 'Dni' => '22345678', 'Celular' => '123456789', 'IdCondicion' => 2, 'IdServicio' => 2],
            ['Nombres'=>'LENIN EDUARDO', 'Apellidos' => 'SAGUAY SANAGUANO', 'Dni' => '32345678', 'Celular' => '123456789', 'IdCondicion' => 3, 'IdServicio' => 1],
            ['Nombres'=>'AZUAY GONZALO', 'Apellidos' => 'BALCAZAR CAMPOVERDE', 'Dni' => '42345678', 'Celular' => '123456789', 'IdCondicion' => 4, 'IdServicio' => 4],
            ['Nombres'=>'BOLÍVAR DANILO FERNANDO', 'Apellidos' => 'GARCÍA GARCÍA', 'Dni' => '52345678', 'Celular' => '123456789', 'IdCondicion' => 2, 'IdServicio' => 1]
        ]);
    }
}
