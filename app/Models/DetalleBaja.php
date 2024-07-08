<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleBaja extends Model
{
    use HasFactory;

    protected $primaryKey = "IdDetalleBaja";
    protected $table = "detallebaja";

    protected $fillable = [
        'IdBaja',
        'IdDetallePatrimonio',
        'Estado'
    ];
}
