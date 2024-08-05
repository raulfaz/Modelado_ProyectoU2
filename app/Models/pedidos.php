<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class pedidos extends Model
{
    use HasFactory;

    protected $collection = 'pedidos';

    protected $fillable = [
        'cliente_id',
        'fecha_pedido',
        'estado_pedido',
        'detalles_pedido',
    ];

    protected $casts = [
        'fecha_pedido' => 'datetime',
    ];
    public function cliente()
    {
        return $this->belongsTo(User::class, 'cliente_id');
    }

    public function distribuciones()
    {
        return $this->hasMany(Distribuciones::class,'pedido_id');
    }

   

}
