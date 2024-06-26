<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $primaryKey = "IdPersonal";

    protected $fillable = [
        'IdPersonal',
        'Nombres',
        'Apellidos',
        'Dni',
        'Celular',
        'Estado',
        'IdCondicion',
        'IdServicio'
    ];

    protected $guarded = [];
    protected $table="personal";
    use HasFactory;
}
