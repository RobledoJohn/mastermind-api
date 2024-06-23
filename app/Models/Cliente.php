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
    //----Relaciones Principal--------
    
    public function equipos()
    {
        return $this->hasMany(Equipo::class);
    }

    //----Relaciones foraneas--------

    // se relaciona clientes con EMPRESA porque un cliente pertenece a una empresa
    public function empresas()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id');
    }

    // se relaciona clientes con CIUDAD porque un cliente pertenece a una ciudad
    public function ciudades()
    {
        return $this->belongsTo(Ciudad::class, 'id_ciudad', 'id');
    }
}
