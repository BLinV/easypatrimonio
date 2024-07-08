<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    use HasFactory;

    protected $primaryKey = "IdDetalleIngreso";
    protected $table = "detalleingreso";

    protected $fillable = [
        'IdIngreso',
        'IdDetallePatrimonio',
        'Estado'
    ];
}
