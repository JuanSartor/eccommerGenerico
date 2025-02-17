<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main class="container-gestor">
        @section('content')

        @if(session()->has('pedido') && $pedido)
        <h1>Tu pedido se ha confirmado</h1>
        <p>
            Tu pedido ha sido guardado con éxito. Una vez que realices la transferencia
            bancaria a la cuenta <strong>7382947289239ADD</strong> con el coste del pedido, será procesado y enviado.
        </p>
        <br/>
        <h3>Datos del pedido:</h3>

        <p>Número de pedido: {{ $pedido->id }}</p>
        <p>Total a pagar: {{ $pedido->coste }} $</p>

        <h3>Productos:</h3>
        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
            </tr>
            @foreach ($pedido->productos as $producto)
            <tr>
                <td>
                    @if ($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" class="img_carrito" />
                    @else
                    <img src="{{ asset('img/camiseta.png') }}" class="img_carrito" />
                    @endif
                </td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->pivot->unidades }}</td>
            </tr>
            @endforeach
        </table>
        @else
        <h1>Tu pedido NO ha podido procesarse</h1>
        @endif


        @show
    </main>


    @include('components.footer')