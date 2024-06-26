<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Patrimonio extends Model
{
    protected $primaryKey = "IdPatrimonio";
    protected $guarded = [];
    protected $table="patrimonio";
    use HasFactory;
}
