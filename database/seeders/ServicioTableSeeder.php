<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ServicioTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::Table('servicio')->insert([
            ['Descripcion'=>'Vigilancia'],
            ['Descripcion'=>'Emergencia'],
            ['Descripcion'=>'Maternidad'],
            ['Descripcion'=>'Sala de operaciones'],
            ['Descripcion'=>'Rayos x'],
            ['Descripcion'=>'Niño'],
            ['Descripcion'=>'Tuberculosis'],
            ['Descripcion'=>'Admisión'],
            ['Descripcion'=>'No transmisibles'],
            ['Descripcion'=>'SIS'],
            ['Descripcion'=>'Lactario'],
            ['Descripcion'=>'Triaje materno'],
            ['Descripcion'=>'Triaje'],
            ['Descripcion'=>'Dental'],
            ['Descripcion'=>'Farmacia'],
            ['Descripcion'=>'Nutrición'],
            ['Descripcion'=>'Hospitalización'],
            ['Descripcion'=>'Metaxenicas'],
            ['Descripcion'=>'Central de esterilización'],
            ['Descripcion'=>'Laboratorio'],
            ['Descripcion'=>'Psicología'],
            ['Descripcion'=>'Referencias'],
            ['Descripcion'=>'Citas'],
            ['Descripcion'=>'Estadística'],
            ['Descripcion'=>'Epi'],
            ['Descripcion'=>'Targa'],
            ['Descripcion'=>'Dirección'],
            ['Descripcion'=>'Limpieza'],
            ['Descripcion'=>'Almacén']
        ]);
    }
}
