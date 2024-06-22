<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ciudad extends Model
{
    use HasFactory;

    protected $table = 'ciudades';

    protected $fillable = [
        'nombre'
    ];

    public function cliente()
    {
        return $this->hasOne(Cliente::class, 'ciudad_id');
    }
}
