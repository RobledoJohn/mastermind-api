<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = [
        'nombre',
        'identificacion',
        'email',
        'clave',
        'telefono',
        'avatar',
        'direccion',
        'estado',
        'enum_tipo_documento',
        'id_empresa',
        'id_ciudad'
    ];

    // Se define relacion uno a muchos con la tabla equipos porque cliente tiene muchos equipos
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id');
    }
}
