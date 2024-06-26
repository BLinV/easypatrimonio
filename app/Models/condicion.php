<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class condicion extends Model
{
    protected $primaryKey = "IdCondicion";
    protected $guarded = [];
    protected $table = "condicion";
    use HasFactory;
}
