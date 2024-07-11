<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePatrimonio extends Model
{
    use HasFactory;

    protected $primaryKey = "IdDetallePatrimonio";
    protected $table = "detallepatrimonio";

    protected $fillable = [
        'IdPatrimonio',
        'CodInterno',
        'CodUTES',
        'CodServicio',
        'Descripcion',
        'Operativo',
        'Baja',
        'IdServicio'
    ];

    protected static function boot() // Define acciones que se deben tomar cuando el modelo se está inicializando.
    {
        parent::boot(); // Asegurar que cualquier comportamiento predeterminado de Eloquent también se ejecute.
        static::creating(function ($model) { // Antes de crear un registro en BD ejecuta un evento
            $model->CodInterno = self::generarCodigo(); // Asigna el codigo al atributo NumeroInterno
        });
    }

    public static function generarCodigo() // Generar código
    {
        do {
            $code = 'INP' . substr(strtoupper(uniqid()), 0, 9);
        } while (self::where('CodInterno', $code)->exists());
        return $code;
    }
}
