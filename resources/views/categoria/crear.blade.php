<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main>
        @section('content')

        <h1>Crear nueva categoria</h1>

        <form method="POST" action="{{ route('guardarCategoria') }}" >
            @csrf

            <label for="supercategoria">Supercategoria</label>
            <select name="supercategoria">
                @foreach ($supercategorias as $supercategoria)
                <option value="{{ $supercategoria->id }}" {{ old('supercategoria', $categoria->id_supercategoria ?? '') == $supercategoria->id ? 'selected' : '' }}>
                    {{ $supercategoria->nombre }}
                </option>
                @endforeach
            </select>

            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required/>

            <input type="submit" value="Guardar" />
        </form>



        @show
    </main>


    @include('components.footer')