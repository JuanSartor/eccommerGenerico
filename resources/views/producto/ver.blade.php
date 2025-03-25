<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main>
        <div id="content">


            @if ($product)
            <br>
            <h1>{{ $product->nombre }}</h1>
            <br>
            <div id="detail-product">
                <div style="margin-left: 20px;" class="image">
                    @if ($product->imagen)
                    <img src="{{ asset('storage/' . $product->imagen) }}" alt="{{ $product->nombre }}">
                    @else
                    <img src="{{ asset('img/camiseta.png') }}" alt="Imagen por defecto">
                    @endif
                </div>
                <div class="data">
                    <br>
                    <p style="text-align: left;" class="description">{{ $product->descripcion }}</p>
                    <p style="text-align: left; font-weight: bold;" class="price">$ {{ $product->precio }}</p>
                    <br>
                    <h6 style="text-align: left; color: #858585; font-size: 14px;">Tiempo de produccion: 30 dias desde la confirmacion del diseño final</h6>
                    <br>
                    <a style="margin-inline:inherit;" href="{{ route('carrito.agregar', ['id' => $product->id]) }}" class="button">Comprar</a>
                </div>
            </div>
            @else
            <h1>El producto no existe</h1>
            @endif

        </div>

    </main>


    @include('components.footer')