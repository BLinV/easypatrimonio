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
}
