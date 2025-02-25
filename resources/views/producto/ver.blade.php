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
                    <p style="text-align: left;" class="description">{{ $product->descripcion }}</p>
                    <p style="text-align: left;" class="price">{{ $product->precio }}$</p>
                    <a href="{{ route('carrito.agregar', ['id' => $product->id]) }}" class="button">Comprar</a>
                </div>
            </div>
            @else
            <h1>El producto no existe</h1>
            @endif

        </div>

    </main>


    @include('components.footer')