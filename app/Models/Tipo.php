<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo extends Model
{
    protected $primaryKey = "IdTipo";
    protected $guarded = [];
    protected $table="tipo";
    use HasFactory;
}
