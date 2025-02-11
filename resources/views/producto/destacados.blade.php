<h1>Algunos de nuestros productos</h1>

<div class="products-container">
    @foreach ($productos as $product)
    <div class="product">
        <a href="{{ route('producto.ver', $product->id) }}">
            @if ($product->imagen)
            <img src="{{ asset('storage/' . $product->imagen) }}" alt="{{ $product->nombre }}">
            @else
            <img src="{{ asset('img/camiseta.png') }}" alt="Imagen por defecto">
            @endif
            <h2>{{ $product->nombre }}</h2>
        </a>
        <p>{{ $product->precio }}</p>
        <a href="{{ route('carrito.agregar', $product->id) }}" class="button">Comprar</a>
    </div>
    @endforeach
</div>
