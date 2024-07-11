<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baja extends Model
{
    use HasFactory;

    protected $primaryKey = "IdBaja";
    protected $table = "baja";

    protected $fillable = [
        'CodigoBaja',
        'Fecha',
        'Observacion',
        'IdPersonal'
    ];
    public static function generarCodigo() // Generar código
    {
        do {
            $code = 'INB' . substr(strtoupper(uniqid()), 0, 7);
        } while (self::where('CodigoBaja', $code)->exists());
        return $code;
    }
}
