<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;

class UserController extends Controller {

    public function miperfil() {
        $usuario = User::findOrFail(Auth::id());
        return view('user.miperfil', compact('usuario'));
    }

    public function usuarios(Request $request) {
        $search = $request->input('search');

        $usuarios = User::where('name', 'like', "%{$search}%")
                ->paginate(9); // Paginar resultados
        return view('user.usuarios', compact('usuarios', 'search'));
    }

    public function save(Request $request) {

        $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
        ]);

        $user = $request->id ? User::findOrFail($request->id) : new User();

        $user->name = $request->name;
        $user->surname = $request->surname;

        $user->save();

        return redirect()->route('user.miperfil')->with('success', 'Usuario editado con éxito.');
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function cambiarContrasenia(Request $request) {
        $request->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', 'confirmed', Password::min(8)],
        ]);

        $user = auth()->user();
        $user->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('user.miperfil')->with('success', 'Contraseña actualizada con éxito.');
    }
}
