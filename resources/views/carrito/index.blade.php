<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main class="container-gestor">
        @section('content')

        <h1>Carrito de la compra</h1>

        @if(count($carrito) > 0)
        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Eliminar</th>
            </tr>

            @foreach ($carrito as $indice => $elemento)
            <tr>
                <td>
                    @if (!empty($elemento['producto']['imagen']))
                    <img src="{{ asset('storage/' . $elemento['producto']['imagen']) }}" class="img_carrito" />
                    @else
                    <img src="{{ asset('img/camiseta.png') }}" class="img_carrito" />
                    @endif
                </td>
                <td>{{ $elemento['producto']['nombre'] }}</td>
                <td>{{ $elemento['precio'] }} $</td>
                <td>
                    {{ $elemento['unidades'] }}
                    <div class="updown-unidades">
                        <a href="{{ route('carrito.incrementar', $indice) }}" class="button">+</a>
                        <a href="{{ route('carrito.decrementar', $indice) }}" class="button">-</a>
                    </div>
                </td>
                <td>
                    <a href="{{ route('carrito.eliminar', $indice) }}" class="button button-carrito button-red">Quitar producto</a>
                </td>
            </tr>
            @endforeach
        </table>

        <br/>
        <div class="delete-carrito">
            <a href="{{ route('carrito.vaciar') }}" class="button button-delete button-red">Vaciar carrito</a>
        </div>
        <div class="total-carrito">
            <h3>Precio total: {{ array_sum(array_map(fn($item) => $item['precio'] * $item['unidades'], $carrito)) }} $</h3>
            <a href="{{ route('pedido.realizar') }}" class="button button-pedido">Hacer pedido</a>
        </div>
        @else
        <p>El carrito está vacío, añade algún producto.</p>
        @endif

        @show
    </main>


    @include('components.footer')