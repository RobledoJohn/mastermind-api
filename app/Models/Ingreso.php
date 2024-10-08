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
        'descripcion',
        'enum_estado_reparacion',
        'id_tecnico',
        'id_equipo'
    ];

    //--------Relaciones Principal--------

    public function detalle_ventas()
    {
        return $this->hasMany(Detalle_Venta::class);
    }

    //--------Relaciones--------

    public function tecnicos()
    {
        return $this->belongsTo(Tecnico::class, 'id_tecnico', 'id');
    }

    //un ingreso esta relacionado a un equipo
    
    public function equipos()
    {
        return $this->belongsTo(Equipo::class, 'id_equipo', 'id');
    }
    
}
