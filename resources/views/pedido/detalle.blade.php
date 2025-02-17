<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <script src="{{ asset('js/mi.js') }}"></script>

    @include('components.header')

    <main class="container-gestor">
        @section('content')

        <br>
        <h1>Detalle del pedido</h1>

        @if ($pedido)
        @if (auth()->user() && Auth::user()->rol === 'admin')
        <h3>Cambiar estado del pedido</h3>
        <form action="{{ route('pedidos.updateEstado') }}" method="POST">
            @csrf
            <input type="hidden" value="{{ $pedido->id }}" name="pedido_id"/>
            <select name="estado">
                <option value="confirm" {{ $pedido->estado == "confirm" ? 'selected' : '' }}>Pendiente</option>
                <option value="preparation" {{ $pedido->estado == "preparation" ? 'selected' : '' }}>En preparación</option>
                <option value="ready" {{ $pedido->estado == "ready" ? 'selected' : '' }}>Preparado para enviar</option>
                <option value="sended" {{ $pedido->estado == "sended" ? 'selected' : '' }}>Enviado</option>
            </select>
            <input type="submit" value="Cambiar estado"/>
        </form>
        <br/>
        <br>
        @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        <br>
        <br>
        @elseif(session('failed'))
        <div class="alert alert-failed">
            {{ session('failed') }}
        </div>
        <br>
        <br>
        @endif
        @endif

        <div style="display: flex;">
            <div style="width: 50%;">
                <h3>Datos del cliente</h3>
                Nombre: {{ $pedido->usuario->name }} <br/>
                Apellido: {{ $pedido->usuario->surname }} <br/>
                Email: {{ $pedido->usuario->email }} <br/><br/>
            </div>
            <div style="width: 50%;">               
                <h3>Dirección de envío</h3>
                Provincia: {{ $pedido->provincia }} <br/>
                Ciudad: {{ $pedido->localidad }} <br/>
                Dirección: {{ $pedido->direccion }} <br/><br/>

                <h3>Datos del pedido:</h3>
                Estado: {{ $pedido->mostrarEstado($pedido->estado) }} <br/>
                Número de pedido: {{ $pedido->id }} <br/>
                Total a pagar: {{ $pedido->coste }} $ <br/>
                Productos:

            </div>
        </div>

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
                    <img src="{{ asset('storage/' . $producto->imagen) }}" class="img_carrito"/>
                    @else
                    <img src="{{ asset('img/camiseta.png') }}" class="img_carrito"/>
                    @endif
                </td>
                <td>
                    <a href="{{ route('producto.ver', $producto->id) }}">{{ $producto->nombre }}</a>
                </td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->pivot->unidades }}</td>
            </tr>
            @endforeach
        </table>
        @endif


        @show
    </main>


    @include('components.footer')
