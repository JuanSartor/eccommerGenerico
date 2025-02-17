<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main class="container-gestor">
        @section('content')

        <h1>Crear nueva supercategoria</h1>

        <form method="POST" action="{{ route('guardar') }}" >
            @csrf
            <label for="nombre">Nombre</label>
            <input type="text" name="nombre" required/>

            <input type="submit" value="Guardar" />
        </form>



        @show
    </main>


    @include('components.footer')