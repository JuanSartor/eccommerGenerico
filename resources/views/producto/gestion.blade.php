<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <script src="{{ asset('js/mi.js') }}"></script>

    @include('components.header')

    <main class="container-gestor">

        <h1>Gestión de productos</h1>
        <br>

        <div class="row">
            <div class="col-md-6">
                <a href="{{ url('/producto/crear')}}" class="button button-small">
                    Crear producto
                </a>
            </div>


            <div class="col-md-6 d-flex align-items-center">
                <form method="GET" action="{{ route('producto.gestion') }}">
                    <div>
                        <input style="width: 250px;" type="text" name="search" placeholder="Buscar producto por nombre..." value="{{ request('search') }}">
                    </div>
                    <div>
                        <button type="submit">Buscar</button>
                    </div>
                </form>

            </div>

        </div>
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
                <th>ESTADO</th>
                <th>ACCIONES</th>
            </tr>
            @foreach ($productos as $producto)
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->precio }}</td>
                <td>
                    @if ($producto->stock == 0)
                    <span class="badge bg-danger">{{ $producto->stock }}</span>
                    @elseif($producto->stock > 0 && $producto->stock < 4)
                    <span class="badge bg-warning">{{ $producto->stock }}</span>
                    @else
                    {{ $producto->stock }}
                    @endif
                </td>
                <td>
                    @if ($producto->eliminado == 0)
                    <span class="badge bg-success">Activo</span>
                    @else
                    <span class="badge bg-danger">Eliminado</span>
                    @endif
                </td>
                <td class="btn-acciones">
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

        <div class="pagination-container">
            {{ $productos->onEachSide(0)->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}

        </div>




    </main>


    @include('components.footer')
