<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PedidoController extends Controller {

//

    public function index() {
        $pedidos = Pedido::all();
        return view('pedido.gestion', compact('pedidos'));
    }

    public function mispedidos() {

        $user = new User();
        $user->id = Auth::id();

        $pedidos = $user->pedidos;
        return view('pedido.gestion', compact('pedidos'));
    }

    public function realizar() {

        return view('pedido.hacer');
    }

    public function detalle($id) {
        $pedido = Pedido::findOrFail($id);
        return view('pedido.detalle', compact('pedido'));
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function updateEstado(Request $request) {
        $pedido = Pedido::findOrFail($request->pedido_id);
        $pedido->estado = $request->estado;
        $pedido->save();

        return redirect()->route('pedido.detalle', $pedido->id)
                        ->with('success', 'El estado del pedido ha sido actualizado.');
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function guardar(Request $request) {

// Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('home')->with('error', 'Debes iniciar sesión para hacer un pedido.');
        }

        $userId = Auth::id();

// Validación de datos
        $validatedData = $request->validate([
            'provincia' => 'required|string|max:255',
            'localidad' => 'required|string|max:255',
            'direccion' => 'required|string|max:255',
        ]);

        $carrito = Session::get('carrito');

        if (!$carrito || count($carrito) === 0) {
            return redirect()->route('carrito.index')->with('error', 'El carrito está vacío.');
        }

        $coste = array_reduce($carrito, fn($sum, $item) => $sum + ($item['precio'] * $item['unidades']), 0);

// Guardar datos en la base de datos
        $pedido = Pedido::create([
            'user_id' => $userId,
            'provincia' => $validatedData['provincia'],
            'localidad' => $validatedData['localidad'],
            'direccion' => $validatedData['direccion'],
            'coste' => $coste,
            'estado' => 'confirm',
        ]);

// Guardar línea de pedidos
        foreach ($carrito as $producto) {
            $pedido->productos()->attach($producto['id_producto'], ['unidades' => $producto['unidades']]);
        }

// Confirmación de pedido
        Session::put('pedido', 'complete');
        return redirect()->route('pedido.confirmar')->with('success', 'Pedido confirmado con éxito.');
    }

    /**
     * 
     */
    public function confirmado() {

        // Verificar si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('home')->with('error', 'Debes iniciar sesión.');
        }

        // Obtener el último pedido del usuario autenticado
        $userId = Auth::id();
        $pedido = Pedido::where('user_id', $userId)->latest()->first();

        if (!$pedido) {
            return redirect()->route('home')->with('error', 'No se encontró ningún pedido.');
        }

        // Obtener productos asociados al pedido
        $productos = $pedido->productos;

        return view('pedido.confirmado', compact('pedido', 'productos'));
    }
}
