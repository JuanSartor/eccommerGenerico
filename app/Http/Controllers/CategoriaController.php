<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CategoriaController extends Controller {

    public function index() {
        $categorias = Categoria::all();
        return view('categoria.index', compact('categorias'));
    }

    public function crear() {

        return view('categoria.crear');
    }

    public function ver($id) {

        $categoria = Categoria::findOrFail($id);

        if (!$categoria) {
            return view('categoria.no-existe');
        }

        $productos = Producto::where('categoria_id', $id)->get();
        return view('categoria.ver', compact('categoria', 'productos'));
    }

    public function save(Request $request) {


// Comprobar si el usuario es administrador (puedes ajustarlo según tu lógica)
        if (!Auth::user() || !Auth::user()->isAdmin()) {
            return response()->json(['error' => 'Acceso no autorizado'], 403);
        }

        // Validación del campo 'nombre'
        $validatedData = $request->validate([
            'nombre' => 'required|string|max:255',
        ]);

        // Guardar la categoría en la base de datos
        $categoria = new Categoria();
        $categoria->nombre = $validatedData['nombre'];

        if ($categoria->save()) {
            return redirect('/categorias');
        }

        return response()->json(['error' => 'Error al guardar la categoría'], 500);
    }
}
