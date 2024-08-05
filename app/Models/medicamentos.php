<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class medicamentos extends Model
{
    use HasFactory;
    protected $fillable = [
        'nombre',
        'descripcion',
        'tipo'
    ];

    public function inventario()
    {
        return $this->hasOne(Inventario::class, 'medicamento_id', '_id');
    }

    
}
