<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class CategoriaController extends Controller {

    public function index() {
        $categorias = Categoria::all();
        return view('categoria.index', compact('categorias'));
    }

    public function ver($id) {

        $categoria = Categoria::findOrFail($id);

        if (!$categoria) {
            return view('categoria.no-existe');
        }

        $productos = Producto::where('categoria_id', $id)->get();
        return view('categoria.ver', compact('categoria', 'productos'));
    }
}
