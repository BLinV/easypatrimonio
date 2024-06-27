<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Baja extends Model
{
    protected $primaryKey = "IdBaja";

    protected $fillable = [
        'IdBaja',
        'CodigoBaja',
        'Fecha',
        'Observacion',
        'IdPersonal'
    ];

    protected $guarded = [];
    protected $table = "baja";
    use HasFactory;
}
