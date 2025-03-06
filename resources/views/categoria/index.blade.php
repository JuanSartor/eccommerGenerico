<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <script src="{{ asset('js/mi.js') }}"></script>

    <!-- Agrega los scripts necesarios para Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>

    @include('components.header')

    <main class="container-gestor">

        <h1>Gestionar categorias</h1>

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
                <form method="GET" action="{{ route('categoria.index') }}">
                    <div>
                        <input style="width: 280px;" type="text" name="search" placeholder="Buscar categoria por nombre..." value="{{ request('search') }}">
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
        <table >
            <tr>
                <th>ID</th>
                <th>CATEGORIA</th>
                <th>SUPERCATEGORIA</th>
                <th>ESTADO</th>
                <th>ACCIONES</th>
            </tr>
            @foreach ($categorias_t as $cat)
            <tr>
                <td>{{ $cat->id }}</td>
                <td>{{ $cat->nombre }}</td>
                <td>{{ $cat->supercategoria->nombre }}</td>

                <td>
                    @if ($cat->visible == 1)
                    <span class="badge bg-success">Visible</span>
                    @else
                    <span class="badge bg-danger">No visible</span>
                    @endif
                </td>
                <td class="btn-acciones">
                    <a href="{{ route('categoria.editar', $cat->id) }}" class="button button-gestion">Editar</a>




                    <button type="button" class="button button-gestion button-red delete-btn" 
                            data-id="{{ $cat->id }}" 
                            data-bs-toggle="modal" 
                            data-bs-target="#confirmModal">
                        Eliminar
                    </button>
                </td>
            </tr>
            @endforeach
        </table>

        <div class="pagination-container">
            {{ $categorias_t->onEachSide(0)->appends(['search' => request('search')])->links('pagination::bootstrap-4') }}
        </div>
    </main>


    @include('components.footer')


    <!-- Modal de confirmación -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Confirmar eliminación</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ¿Estás seguro de que deseas eliminar esta categoría?
                </div>
                <div class="modal-footer">
                    <form>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    </form>
                    <form id="deleteForm" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Eliminar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Script para actualizar la acción del formulario -->
    <script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {
            let categoriaId = this.getAttribute("data-id");
            let deleteForm = document.getElementById("deleteForm");
            deleteForm.setAttribute("action", "{{ route('categoria.eliminar', '') }}/" + categoriaId);
        });
    });
});
    </script>