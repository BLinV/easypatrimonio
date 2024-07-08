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

    protected static function boot() // Define acciones que se deben tomar cuando el modelo se está inicializando.
    {
        parent::boot(); // Asegurar que cualquier comportamiento predeterminado de Eloquent también se ejecute.
        static::creating(function ($model) { // Antes de crear un registro en BD ejecuta un evento
            $model->NumeroInterno = self::generarCodigo(); // Asigna el codigo al atributo NumeroInterno
        });
    }

    public static function generarCodigo() // Generar código
    {
        $code = 'INT' . substr(strtoupper(uniqid()), 0, 7); // Código con prefijo
        while (self::where('NumeroInterno', $code)->exists()) { // Verificar si el código ya existe
            $code = 'INT' . substr(strtoupper(uniqid()), 0, 7);
        }
        return $code;
    }
}
