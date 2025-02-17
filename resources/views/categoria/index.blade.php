<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main class="container-gestor">
        @section('content')

        <h1>Gestionar categorias</h1>

        <div style="display: flex; margin-top: 20px;">
            <a href="{{ url('/categoria/crear')}}" class="button button-small">
                Crear categoria
            </a>

            <a style="margin-left: 40px;" href="{{ url('/supercategoria/crear')}}" class="button button-small">
                Crear supercategoria
            </a>
        </div>
        <table border="1">
            <tr>
                <th>ID</th>
                <th>CATEGORIA</th>
                <th>SUPERCATEGORIA</th>
            </tr>
            @foreach ($categorias as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->nombre }}</td>
                <td>{{ $cat->supercategoria->nombre }}</td>
            </tr>
            @endforeach
        </table>



        @show
    </main>


    @include('components.footer')