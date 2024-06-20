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
        'cliente_id', // Clave foránea a Cliente
        'modelo_id'   // Clave foránea a Modelo
    ];

    // Relación Muchos a Uno: Un equipo pertenece a un cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    // Relación Muchos a Uno: Un equipo pertenece a un modelo
    public function modelo()
    {
        return $this->belongsTo(Modelo::class);
    }
}
