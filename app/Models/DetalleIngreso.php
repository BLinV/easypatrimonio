<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleIngreso extends Model
{
    protected $primaryKey = "IdDetalleIngreso";
    protected $guarded = [];
    protected $table = "detalleingreso";
    use HasFactory;
}
