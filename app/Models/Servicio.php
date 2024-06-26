<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    protected $primaryKey = "IdServicio";
    protected $guarded = [];
    protected $table="servicio";
    use HasFactory;

    public function personal()
    {
        return $this->hasMany(Personal::class, 'IdServicio');
    }

    public function patrimonio()
    {
        return $this->hasMany(Patrimonio::class, 'IdServicio');
    }
}
