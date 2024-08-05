<?php

namespace App\Observers;
use App\Models\Pedidos;
use App\Models\Inventario;

class PedidoObserver
{
    public function created(Pedidos $pedido)
    {
        $detalles = json_decode($pedido->detalles_pedido, true);
        
        foreach ($detalles as $detalle) {
            $inventario = Inventario::where('medicamento_id', $detalle['medicamento_id'])->first();
            if ($inventario) {
                $inventario->cantidad -= $detalle['cantidad'];
                $inventario->save();
            }
        }
    }
}
