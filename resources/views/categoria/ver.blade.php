<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main>
        <div id="content">
            @if ($categoria)
            <h1>{{ $categoria->nombre }}</h1>

            @if ($productos->isEmpty())
            <p>No hay productos para mostrar</p>
            @else


            @foreach ($productos as $product)
            <div class="product">
                <a href="{{ route('producto.gestion', ['id' => $product->id]) }}">
                    @if ($product->imagen)
                    <img src="{{ asset('storage/' . $product->imagen) }}" />
                    @else
                    <img src="{{ asset('img/camiseta.png') }}" />
                    @endif
                    <h2>{{ $product->nombre }}</h2>
                </a>
                <p>{{ $product->precio }}</p>

                <a href="{{ route('carrito.agregar', ['id' => $product->id]) }}" class="button">Comprar</a>

            </div>
            @endforeach



            <div>
                {{ $productos->links() }}
            </div>

            @endif
            @else
            <h1>La categoría no existe</h1>
            @endif
        </div>
    </main>


    @include('components.footer')