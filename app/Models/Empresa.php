<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $primaryKey = "id_empresa"; 

    protected $fillable = [
        'nombre',
        'nit',
        'email',
        'clave',
        'avatar',
        'direccion',
        'telefono',
        'estado'
    ];

    // Se define relacion uno a muchos con la tabla cliente porque empresa tiene muchos clientes
    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }
}
