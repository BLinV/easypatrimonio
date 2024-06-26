<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallePatrimonio extends Model
{
    protected $primaryKey = "IdDetallePatrimonio";
    protected $guarded = [];
    protected $table = "detallepatrimonio";
    use HasFactory;
}
