<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_Detalle extends Model
{
    use HasFactory;

    protected $table = 'tipos_detalles';

    protected $fillable = [
        'enum_tipo_detalle', 
        'id_ingreso', 
        'id_producto'
    ];

    //--------Relaciones Principal--------


    //-------- Relaciones foraneas ---------
    // Relación Uno a Uno: Un tipo de detalle corresponde a un ingreso

    public function ingresos()
    {
        return $this->belongsTo(Ingreso::class, 'id_ingreso', 'id');
    }

    // Relación Uno a Uno: Un tipo de detalle corresponde a un producto

    public function productos()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id');
    }
}
