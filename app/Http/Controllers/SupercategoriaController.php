<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Supercategoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupercategoriaController extends Controller {

    public function index(Request $request) {

        $search = $request->input('search'); // Obtener el término de búsqueda

        $supercategorias_t = Supercategoria::where('nombre', 'like', "%{$search}%")->paginate(10);
        return view('supercategoria.index', compact('supercategorias_t', 'search'));
    }

    public function crear() {

        return view('supercategoria.crear');
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
        $supercategoria = new Supercategoria();
        $supercategoria->nombre = $validatedData['nombre'];

        if ($supercategoria->save()) {
            return redirect('/supercategorias');
        }

        return response()->json(['error' => 'Error al guardar la categoría'], 500);
    }
}
