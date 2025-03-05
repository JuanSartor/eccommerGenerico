<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <script src="{{ asset('js/mi.js') }}"></script>
    @include('components.header')

    <main class="container-gestor">

        <h1>Gestión usuarios</h1>
        <br>

        <div class="row">
            <div class="col-md-6">
                <a href="{{ url('/usuario/crear')}}" class="button button-small">
                    Crear Usuario
                </a>
            </div>


            <div class="col-md-6 d-flex align-items-center">
                <form method="GET" action="{{ route('user.usuarios') }}">
                    <div>
                        <input style="width: 250px;" type="text" name="search" placeholder="Buscar usuario por nombre..." value="{{ request('search') }}">
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
                <th>APELLIDO</th>
                <th>EMAIL</th>
                <th>ACCIONES</th>
            </tr>
            @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->id }}</td>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->surname }}</td>
                <td>{{ $usuario->email }}</td>
                <td class="btn-acciones">
                    <a href="{{ route('usuario.editar', $usuario->id) }}" class="button button-gestion">Editar</a>

                    <form action="{{ route('productos.eliminar', $usuario->id) }}" method="POST" style="display: inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button button-gestion button-red">Eliminar</button>
                    </form>
                </td>
            </tr>
            @endforeach

        </table>

        <div class="pagination-container">
            {{ $usuarios->onEachSide(0)->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}

        </div>



    </main>


    @include('components.footer')