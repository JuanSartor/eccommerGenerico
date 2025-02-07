<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Pedido;

class PedidoController extends Controller {

    //

    public function index() {
        $pedidos = Pedido::all();
        return view('pedido.gestion', compact('pedidos'));
    }

    public function detalle($id) {
        $pedido = Pedido::findOrFail($id);
        return view('pedidos.detalle', compact('pedido'));
    }

    public function updateEstado(Request $request) {
        $pedido = Pedido::findOrFail($request->pedido_id);
        $pedido->estado = $request->estado;
        $pedido->save();

        return redirect()->route('pedidos.detalle', $pedido->id)
                        ->with('success', 'El estado del pedido ha sido actualizado.');
    }
}
