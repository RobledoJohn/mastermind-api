<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingreso extends Model
{
    use HasFactory;

    protected $table = 'ingresos';

    protected $fillable = [
        'enlace_seguimiento',
        'enum_estado_reparacion',
        'id_tecnico',
        'id_equipo', 
        'id_detalle_venta'
    ];

    //--------Relaciones Principal--------

    //--------Relaciones--------

    public function tecnicos()
    {
        return $this->belongsTo(Tecnico::class, 'id_tecnico', 'id');
    }

    //un ingreso esta relacionado a un equipo
}
