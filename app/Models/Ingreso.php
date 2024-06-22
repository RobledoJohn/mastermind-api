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
        'id_equipo'
    ];

    //--------Relaciones Principal--------

    public function ingresos()
    {
        return $this->hasMany(Ingreso::class);
    }

    public function tipos_detalle()
    {
        return $this->hasOne(Tipo_Detalle::class);
    }

    //--------Relaciones--------

    public function tecnicos()
    {
        return $this->belongsTo(Tecnico::class, 'id_tecnico', 'id');
    }

    //falta crear tabla intermedia con equipos porque relacion muchos a muchos!!!!!
}
