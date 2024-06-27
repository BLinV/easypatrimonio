<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrimonio extends Model
{
    use HasFactory;

    protected $primaryKey = "IdPatrimonio";
    protected $table = "patrimonio";

    protected $fillable = [
        'IdTipo',
        'IdMarca',
        'Modelo',
        'IdCategoria'
    ];
}
