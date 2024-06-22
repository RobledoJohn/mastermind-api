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

    // se relaciona clientes con empresa porque un cliente pertenece a una empresa
    public function empresa()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id');
    }
    
    // se relaciona clientes con ciudad porque un cliente pertenece a una ciudad
    public function ciudad()
    {
        return $this->belongsTo(Ciudad::class, 'ciudad_id');
    }
}
