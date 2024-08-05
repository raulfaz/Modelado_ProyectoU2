<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class usuarios extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'email',
        'password',
        'tipo',
        'direccion',
        'telefono'
    ];

    public function pedidos()
    {
        return $this->hasMany(Pedidos::class, 'cliente_id');
    }

    public function distribuciones()
    {
        return $this->hasMany(Distribuciones::class, 'distribuidor_id');
    }
}
