<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Pedido;
use App\Models\Envio;
use Illuminate\Support\Facades\Auth;

class EnvioController extends Controller {

    public function guardar(Request $request) {

// Verifica si el usuario está autenticado
        if (!Auth::check()) {
            return redirect()->route('home')->with('error', 'Debes iniciar sesión para hacer un pedido.');
        }

        $userId = Auth::id();

// Validación de datos
        $validatedData = $request->validate([
            'provincia' => 'string|max:255',
            'localidad' => 'string|max:255',
            'direccion' => 'string|max:255',
            'nombre_receptor' => 'string|max:255',
            'dni_receptor' => 'string|max:255',
            'telefono' => 'string|max:255',
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
            'costo_productos' => $coste,
            'costo_envio' => '111111',
            'estado' => 'confirm',
        ]);

        // Guardar datos del envio en la base de datos
        Envio::create([
            'user_id' => $userId,
            'pedido_id' => $pedido->id,
            'provincia' => $validatedData['provincia'],
            'localidad' => $validatedData['localidad'],
            'direccion' => $validatedData['direccion'],
            'nombre_receptor' => $validatedData['nombre_receptor'],
            'dni_receptor' => $validatedData['dni_receptor'],
            'telefono' => $validatedData['telefono'],
            'tipo_envio' => $request['tipo_envio'],
        ]);

// Guardar línea de pedidos
        foreach ($carrito as $producto) {
            $pedido->productos()->attach($producto['id_producto'], ['unidades' => $producto['unidades']]);
        }

// Confirmación de pedido
        Session::put('pedido', 'complete');

        //vacio el carrito
        Session::forget('carrito');
        return redirect()->route('pedido.confirmar')->with('success', 'Pedido confirmado con éxito.');
    }
}
