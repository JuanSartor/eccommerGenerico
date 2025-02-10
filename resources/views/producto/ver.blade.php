<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main>
        @section('content')


        @if ($product)
        <h1>{{ $product->nombre }}</h1>
        <div id="detail-product">
            <div class="image">
                @if ($product->imagen)
                <img src="{{ asset('storage/' . $product->imagen) }}" alt="{{ $product->nombre }}">
                @else
                <img src="{{ asset('img/camiseta.png') }}" alt="Imagen por defecto">
                @endif
            </div>
            <div class="data">
                <p class="description">{{ $product->descripcion }}</p>
                <p class="price">{{ $product->precio }}$</p>
                <a href="{{ route('carrito.agregar', ['id' => $product->id]) }}" class="button">Comprar</a>
            </div>
        </div>
        @else
        <h1>El producto no existe</h1>
        @endif


        @show
    </main>


    @include('components.footer')