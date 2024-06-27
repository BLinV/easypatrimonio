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
        'CodUTES',
        'CodInterno',
        'Descripcion',
        'Operativo',
        'Baja',
        'IdServicio'
    ];
}
