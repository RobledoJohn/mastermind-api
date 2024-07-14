<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = 'empresas';

    protected $primaryKey = "id"; 

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
    // Se define relacion uno a muchos con la tabla tecnicos porque empresa tiene muchos tecnicos
    public function tecnicos()
    {
        return $this->hasMany(Tecnico::class);
    }
    // Se define relacion uno a muchos con la tabla ventas porque empresa tiene muchos ventas
    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }
    // Se define relacion uno a muchos con la tabla productos porque empresa tiene muchos productos
    public function productos()
    {
        return $this->hasMany(Producto::class);
    }
}
