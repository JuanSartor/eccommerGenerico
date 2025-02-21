<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main class="container-gestor">

        <h1>Gestionar Supercategorias</h1>

        <div class="row">
            <div class="col-md-6 6 d-flex align-items-center">

                <a href="{{ url('/categoria/crear')}}" class="button button-small">
                    Crear categoria
                </a>

                <a style="margin-left: 20px;"  href="{{ url('/supercategoria/crear')}}" class="button button-small">
                    Crear supercategoria
                </a>

            </div>

            <div class="col-md-6 d-flex align-items-center">
                <form method="GET" action="{{ route('supercategoria.index') }}">
                    <div>
                        <input style="width: 280px;" type="text" name="search" placeholder="Buscar supercategoria por nombre..." value="{{ request('search') }}">
                    </div>
                    <div>
                        <button type="submit">Buscar</button>
                    </div>
                </form>

            </div>

        </div>

        <br>
        <br>
        <table>
            <tr>
                <th>ID</th>
                <th>SUPERCATEGORIA</th>
            </tr>
            @foreach ($supercategorias_t as $sup)
            <tr>
                <td>{{ $sup->id }}</td>
                <td>{{ $sup->nombre }}</td>
            </tr>
            @endforeach
        </table>

        <div class="pagination-container">
            {{ $supercategorias_t->appends(['search' => request('search')])->links() }}
        </div>


    </main>


    @include('components.footer')