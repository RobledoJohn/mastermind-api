<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos';

    protected $fillable = [
        'SKU',
        'imagen',
        'nombre',
        'descripcion',
        'cantidad',
        'precio',
        'estado',
        'id_empresa'
    ];

    // se relaciona productos con empresa porque un productos pertenece a una empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id');
    }
}
