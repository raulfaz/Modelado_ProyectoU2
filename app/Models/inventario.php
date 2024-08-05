<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use MongoDB\Laravel\Eloquent\Model;

class inventario extends Model
{
    use HasFactory;

    protected $collection = 'inventario';
    protected $fillable = [
        'medicamento_id',
        'cantidad',
        'ubicacion'
    ];

    public function medicamento()
    {
        return $this->belongsTo(Medicamentos::class, 'medicamento_id', '_id');
    }
}
