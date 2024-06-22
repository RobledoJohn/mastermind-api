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
        'id_cliente'
    ];

    // se relaciona ventas con EMPRESA porque una venta pertenece a una empresa
    public function empresas()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id');
    }

    // se relaciona ventas con CLIENTE porque una venta pertenece a un cliente

    public function clientes()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }
}
