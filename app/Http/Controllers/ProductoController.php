<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller {

    //

    public function index() {
        $productos = Producto::all();
        return view('producto.gestion', compact('productos'));
    }

    public function crear() {

        $categorias = Categoria::all(); // Obtenemos las categorías
        return view('producto.crear', compact('categorias'));
    }

    public function editar($id) {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all();

        return view('producto.crear', compact('producto', 'categorias'));
    }

    public function guardar(Request $request) {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'precio' => 'required|numeric',
            'stock' => 'required|integer',
            'categoria' => 'required|exists:categorias,id',
            'imagen' => 'nullable|image|max:2048',
        ]);

        $producto = $request->id ? Producto::findOrFail($request->id) : new Producto();

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->categoria_id = $request->categoria;

        // Guardar imagen si existe
        if ($request->hasFile('imagen')) {
            $path = $request->file('imagen')->store('productos', 'public');
            $producto->imagen = $path;
        }

        $producto->save();

        return redirect()->route('producto.gestion')->with('success', 'Producto guardado con éxito.');
    }

    public function eliminar($id) {
        $producto = Producto::findOrFail($id);

        if ($producto->delete()) {
            session()->flash('delete', 'complete');
        } else {
            session()->flash('delete', 'failed');
        }

        return redirect()->route('producto.gestion');
    }

    public function ver($id) {
        $product = Producto::find($id);

        return view('producto.ver', compact('product'));
    }
}
