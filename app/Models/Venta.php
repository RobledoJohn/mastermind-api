<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    use HasFactory;

    protected $table = 'ventas';

    protected $fillable = [
        'enum_medio_pago',
        'id_empresa', 
        'id_detalle_venta'
    ];

    // se relaciona ventas con EMPRESA porque una venta pertenece a una empresa
    public function empresas()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id');
    }

    // se relaciona ventas con DETALLE_VENTA porque una venta tiene un detalle de venta

    public function detalle_venta()
    {
        return $this->belongsTo(Detalle_Venta::class, 'id_detalle_Venta', 'id');//!!!!cambiar venta por v minuscula
    }
}
