<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <script src="{{ asset('js/mi.js') }}"></script>

    @include('components.header')

    <main class="container-gestor">

        <br>
        <h1>Detalle del pedido</h1>

        @if ($pedido)
        @if (auth()->user() && Auth::user()->rol === 'admin')
        <h3>Cambiar estado del pedido</h3>
        <div class="row">
            <div class="col-md-6">

                <form action="{{ route('pedidos.updateEstado') }}" method="POST">
                    @csrf
                    <input type="hidden" value="{{ $pedido->id }}" name="pedido_id"/>
                    <select name="estado">
                        <option value="confirm" title="aun no seleccion metodo de pago" {{ $pedido->estado == "confirm" ? 'selected' : '' }}>Pendiente</option>
                        <option value="esperandoConfirmacion" title="metodo de pago seleccionado, falta recibir confirmacion" {{ $pedido->estado == "esperandoConfirmacion" ? 'selected' : '' }}>Pago pendiente</option>
                        <option value="pagado" {{ $pedido->estado == "pagado" ? 'selected' : '' }}>Pago confirmado</option>
                        <option value="cancelado" {{ $pedido->estado == "cancelado" ? 'selected' : '' }}>Cancelado</option>
                    </select>
                    <input type="submit" value="Cambiar estado"/>
                </form>
            </div>
            <div class="col-md-6">
                @if(isset($pago->init_point_mercadopago))
                <a href="{{ $pago->init_point_mercadopago }}" target="_blank" class="btn btn-primary">
                    Pagar Mercado Pago
                </a>
                @else
                @endif
            </div>
        </div>
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

                <h3>Datos del receptor</h3>
                Nombre receptor: {{ $envio->nombre_receptor }} <br/>
                DNI receptor: {{ $envio->dni_receptor }} <br/>
                Telefono: {{ $envio->telefono }} <br/><br/><br/>


                Productos
            </div>
            <div style="width: 50%;">               
                <h3>Dirección de envío</h3>
                Provincia: {{ $envio->provincia }} <br/>
                Ciudad: {{ $envio->localidad }} <br/>
                Dirección: {{ $envio->direccion }} <br/><br/>

                <h3>Datos del pedido:</h3>

                @switch($envio->tipo_envio)
                @case('coordinarEnvio')
                <span style="font-weight: bold;">Tipo envio:</span>  a coordinar con cliente<br/>
                @break

                @case('envioSucursal')
                <span style="font-weight: bold;">Tipo envio:</span> envio a sucursal <br/>
                @break

                @case('envioDomicilio')
                <span style="font-weight: bold;">Tipo envio:</span> envio a domicilio <br/>
                @break
                @endswitch

                Estado: {{ $pedido->mostrarEstado($pedido->estado) }} <br/>
                Número de pedido: {{ $pedido->id }} <br/><br/>
                <span style="font-weight: bold;">Total a pagar: </span> {{ $pedido->coste }} $ <br/>

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


    </main>


    @include('components.footer')
