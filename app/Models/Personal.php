<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $primaryKey = "IdPersonal";
    protected $table = "personal";

    protected $fillable = [
        'IdPersonal',
        'Dni',
        'Nombres',
        'Apellidos',
        'Celular',
        'Estado',
        'IdCondicion',
        'IdServicio'
    ];

    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function servicio()
    {
        return $this->belongsTo(Servicio::class, 'IdServicio');
    }
}
