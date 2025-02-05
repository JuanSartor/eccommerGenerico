<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main>
        @section('content')

        <h1>Gestionar categorias</h1>

        <a href="{{ url('/categoria/crear')}}" class="button button-small">
            Crear categoria
        </a>

        {{--     <table>
        <tr>
                    <th>ID</th>
                    <th>NOMBRE</th>
    </tr        >
    <?php while ($cat = $categorias->fetch_object()): ?>
        <tr>
            <td>        <?= $cat->id; ?></td>
            <td>        <?= $cat->nombre; ?></td>
    </tr>
<?php endwhile; ?>
        </table>
        
        --}}

@show
</main>


@include('components.footer')