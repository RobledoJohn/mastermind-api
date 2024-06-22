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
        'enum_tipo_equipos'
    ];

    // Relación Uno a Uno: Un modelo es un equipo
    public function equipos()
    {
        return $this->hasOne(Equipo::class);
    }
}
