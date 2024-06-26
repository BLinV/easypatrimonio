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

    /*protected $fillable = [
        'name', 'status', 'url'
    ];*/

    public function marca()
    {
        return $this->belongsTo(Marca::class, 'IdMarca');
    }

    public function tipo()
    {
        return $this->belongsTo(Tipo::class, 'IdTipo');
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class, 'IdCategoria');
    }

    public function detalle()
    {
        return $this->hasMany(DetallePatrimonio::class, 'IdPatrimonio');
    }
}
