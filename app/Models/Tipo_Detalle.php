<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_Detalle extends Model
{
    use HasFactory;

    protected $table = 'tipos_detalles';

    protected $fillable = [
        'enum_tipo_detalle'
    ];
}
