<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main>
        @section('content')

        <h1>Gestión de productos</h1>

        <a href="{{ url('/producto/crear')}}" class="button button-small">
            Crear producto
        </a>
        @if(session('producto') == 'complete')
        <strong class="alert_green">El producto se ha creado correctamente</strong>
        @elseif(session('producto') == 'failed')
        <strong class="alert_red">El producto NO se ha creado correctamente</strong>
        @endif

        @if(session('delete') == 'complete')
        <strong class="alert_green">El producto se ha borrado correctamente</strong>
        @elseif(session('delete') == 'failed')
        <strong class="alert_red">El producto NO se ha borrado correctamente</strong>
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
