<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tecnico extends Model
{
    use HasFactory;

    protected $table = 'tecnicos';

    protected $fillable = [
        'nombre',
        'email',
        'clave',
        'telefono',
        'avatar',
        'estado',
        'id_empresa'
    ];
    // // se relaciona tecnicos con EMPRESA porque un tecnico pertenece a una empresa
    public function empresas()
    {
        return $this->belongsTo(Empresa::class, 'id_empresa', 'id');
    }
}
