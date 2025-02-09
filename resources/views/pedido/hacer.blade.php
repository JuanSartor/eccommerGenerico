<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main>
        @section('content')


        @if (Auth::check())
        <h1>Hacer pedido</h1>
        <p>
            <a href="{{ route('carrito.index') }}">Ver los productos y el precio del pedido</a>
        </p>
        <br/>

        <h3>Dirección para el envío:</h3>
        <form action="{{ route('pedido.guardar') }}" method="POST">
            @csrf
            <label for="provincia">Provincia</label>
            <input type="text" name="provincia" required />

            <label for="localidad">Ciudad</label>
            <input type="text" name="localidad" required />

            <label for="direccion">Dirección</label>
            <input type="text" name="direccion" required />

            <input type="submit" value="Confirmar pedido" />
        </form>
        @else
        <h1>Necesitas estar identificado</h1>
        <p>Necesitas estar logueado en la web para poder realizar tu pedido.</p>
        @endif



        @show
    </main>


    @include('components.footer')
