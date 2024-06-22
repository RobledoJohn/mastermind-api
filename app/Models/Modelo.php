<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;

    protected $table = 'modelos';

    protected $fillable = [
        'nombre',
        'enum_tipo_equipos',
        'id_marca'
    ];

    // Relación Uno a Uno: Un modelo es un equipo
    public function equipos()
    {
        return $this->hasOne(Equipo::class);
    }

    // Relación Uno a Muchos: Un modelo pertenece a una marca
    public function marca()
    {
        return $this->belongsTo(Marca::class, 'id_marca', 'id');
    }
}
