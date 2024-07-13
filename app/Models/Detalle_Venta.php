<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detalle_Venta extends Model
{
    use HasFactory;

    protected $table = 'detalle_ventas';

    protected $fillable = [
        'cantidad',
        'monto',
        'descripcion', 
        'enum_tipo_detalle',
        'id_producto',
        'id_ingreso'
    ];


    //--------Relaciones--------

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function productos()
    {
        return $this->belongsTo(Producto::class, 'id_producto', 'id');
    }

    public function ingresos()
    {
        return $this->belongsTo(Ingreso::class, 'id_ingreso', 'id');
    }

}
