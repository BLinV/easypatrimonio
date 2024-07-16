<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InformacionBaseSeeder extends Seeder
{
    public function run()
    {
        $fecha = Carbon::now();
        $fecha->setTimezone('America/Lima');
        DB::Table('origen')->insert([
            ['Descripcion'=>'UTES - RDR - RECURSOS DIRECTAMENTE RECAUDADOS', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'UTES - RO - RECURSOS ORDINARIOS', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'UTES - DIT - DONACIONES Y TRANSFERENCIAS', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'OTRO - [CAJA CHICA, DONACIONES, ETC]', 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
        DB::Table('servicio')->insert([
            ['Descripcion'=>'Vigilancia', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Emergencia', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Maternidad', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Sala de operaciones', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Rayos x', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Niño', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Tuberculosis', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Admisión', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'No transmisibles', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'SIS', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Lactario', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Triaje materno', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Triaje', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Dental', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Farmacia', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Nutrición', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Hospitalización', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Metaxenicas', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Central de esterilización', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Laboratorio', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Psicología', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Referencias', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Citas', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Estadística', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Epi', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Targa', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Dirección', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Limpieza', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Almacén', 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
        DB::Table('condicion')->insert([
            ['Descripcion'=>'Contratado', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'No Titular', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Titular', 'created_at' => $fecha, 'updated_at' => $fecha],
            ['Descripcion'=>'Practicante', 'created_at' => $fecha, 'updated_at' => $fecha]
        ]);
        DB::Table('users')->insert([
            ['name'=>'HelenSaldaña', 'email' => 'helen@mail.com', 'password' => '$2y$10$qQVsb2bBDflsRkaZWpLCeOeByKl0A5eMfzS1P6eBNinOB0dAWIg3W', 'created_at' => $fecha, 'updated_at' => $fecha],
        ]);
        DB::Table('personal')->insert([
            ['Nombres'=>'HELEN LISET', 'Apellidos' => 'HARO SALDAÑA', 'Dni' => '18161616', 'Celular' => '949977777', 'IdCondicion' => 1, 'IdServicio' => 29, 'IdUsuario' => 1, 'created_at' => $fecha, 'updated_at' => $fecha],
        ]);
    }
}
