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
        'id_ingreso',
        'id_venta'
    ];


    //--------Relaciones--------



}
