<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UbicacionPatrimonio extends Model
{
    protected $primaryKey = "IdUbicacionPatrimonio";
    protected $guarded = [];
    protected $table="ubicacionpatrimonio";
    use HasFactory;
}
