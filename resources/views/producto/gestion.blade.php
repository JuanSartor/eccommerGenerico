<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <script src="{{ asset('js/mi.js') }}"></script>

    @include('components.header')

    <main class="container-gestor">
        @section('content')

        <br>
        <h1>Gestión de productos</h1>
        <br>

        <a href="{{ url('/producto/crear')}}" class="button button-small">
            Crear producto
        </a>
        <br>

        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        <br>
        @elseif(session('failed'))
        <div class="alert alert-failed">
            {{ session('failed') }}
        </div>
        <br>
        @endif

        <table>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>STOCK</th>
                <th>ACCIONES</th>
            </tr>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->stock }}</td>
                <td>
                    <a href="{{ route('producto.editar', $producto->id) }}" class="button button-gestion">Editar</a>

                    <form action="{{ route('productos.eliminar', $producto->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button button-gestion button-red">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>



        @show
    </main>


    @include('components.footer')
