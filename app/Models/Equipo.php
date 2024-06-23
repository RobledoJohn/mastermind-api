<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';

    protected $fillable = [
        'estado',
        'id_cliente', // Clave foránea a Cliente
        'id_modelo'   // Clave foránea a Modelo
    ];
    //-------------------- Relaciones Principales --------------------

    //un equipo puede tener muchos ingresos



    // Relación Muchos a Uno: Un equipo pertenece a un cliente
    public function clientes()
    {
        return $this->belongsTo(Cliente::class, 'id_cliente', 'id');
    }

    // // Relación Uno a Uno: Un equipo corresponde a un modelo
    public function modelos()
    {
        return $this->belongsTo(Modelo::class, 'id_modelo', 'id');
    }
}
