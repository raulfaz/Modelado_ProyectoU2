<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class detalles_pedido extends Model
{
    use HasFactory;

    protected $collection = null;

    protected $fillable = [
        'medicamento_id',
        'cantidad'
    ];
    protected $casts = [
        'medicamento_id' => 'string',
        'cantidad' => 'integer',
    ];
    
    public function medicamento()
    {
        return $this->belongsTo(Medicamentos::class,'medicamento_id');
    }
}
