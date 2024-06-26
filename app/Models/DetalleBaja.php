<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetalleBaja extends Model
{
    protected $primaryKey = "IdDetalleBaja";
    protected $guarded = [];
    protected $table = "detallebaja";
    use HasFactory;
}
