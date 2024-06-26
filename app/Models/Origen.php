<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Origen extends Model
{
    protected $primaryKey = "IdOrigen";
    protected $guarded = [];
    protected $table="origen";
    use HasFactory;
}
