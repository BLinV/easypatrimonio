<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $primaryKey = "IdIngreso";
    protected $table = "ingreso";

    protected $fillable = [ // array de atributos que se pueden asignar en masa
        'NumeroInterno',
        'NumeroPecosa',
        'Fecha',
        'IdOrigen',
        'OtroOrigen',
        'Observacion',
        'IdPersonal'
    ];

    public static function generarCodigo() // Generar código
    {
        do {
            // Código con prefijo, genera un identificador único con los milisegundos, [si uso MD5 lo convierte a un hash
            // de 32 caracteres, luego a mayusculas], toma los 7 primeros caracteres y alade INT
            $code = 'NuI' . substr(strtoupper(uniqid()), 0, 7);
        } while (self::where('NumeroInterno', $code)->exists()); // Verificar si el código ya existe
        return $code;
    }
}
