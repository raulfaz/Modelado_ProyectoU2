<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class distribuciones extends Model
{
    use HasFactory;

    protected $collection = 'distribuciones';

    protected $fillable = [
        'pedido_id',
        'distribuidor_id',
        'fecha_distribucion',
        'estado_distribucion'
    ];

    public function pedido()
    {
        return $this->belongsTo(Pedidos::class, 'pedido_id');
    }

    public function distribuidor()
    {
        return $this->belongsTo(Usuarios::class, 'distribuidor_id');
    }
}
