<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <script src="{{ asset('js/mi.js') }}"></script>

    @include('components.header')

    <main class="container-gestor">
        @section('content')


        @if (Auth::check())
        <h1>Detalles de envio</h1>
        <p>
            <a href="{{ route('carrito.index') }}">Ver los productos y el precio del pedido</a>
        </p>
        <br/>

        <h3>Datos para el envío:</h3>
        <form action="{{ route('envio.guardar') }}" method="POST">
            @csrf


            <label>
                <input checked="true" type="radio" name="tipo_envio" value="envioDomicilio" onclick="toggleFields()"> Envio a domicilio
            </label>
            <label>
                <input type="radio" name="tipo_envio" value="envioSucursal" onclick="toggleFields()"> Envio a sucursal
            </label>
            <label>
                <input type="radio" name="tipo_envio" value="coordinarEnvio" onclick="toggleFields()"> Coordinar retiro o entrega
            </label>


            <div id="dir_env">
                <label for="provincia">Provincia</label>
                <input type="text" name="provincia"  />

                <label for="localidad">Ciudad</label>
                <input type="text" name="localidad"  />


                <label for="direccion">Dirección</label>
                <input type="text" name="direccion"  />
            </div>

            <label for="nombre_receptor">Nombre receptor</label>
            <input type="text" name="nombre_receptor" required />

            <label for="dni_receptor">DNI receptor</label>
            <input type="text" name="dni_receptor" required />

            <label for="telefono">Telefono</label>
            <input type="text" name="telefono" required />



            <input type="submit" value="Confirmar pedido" />
        </form>
        @else
        <h1>Necesitas estar identificado</h1>
        <p>Necesitas estar logueado en la web para poder realizar tu pedido.</p>
        @endif



        @show
    </main>


    @include('components.footer')
