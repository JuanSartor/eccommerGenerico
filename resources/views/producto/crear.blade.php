<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main>
        @section('content')


        <h1>{{ isset($producto) ? "Editar producto $producto->nombre" : "Crear nuevo producto" }}</h1>

        <div class="form_container">
            <form action="{{ isset($producto) ? route('producto.guardar', $producto->id) : route('producto.guardar') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(isset($producto))
                <input type="hidden" name="id" value="{{ $producto->id }}">
                @endif

                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" value="{{ old('nombre', $producto->nombre ?? '') }}" />

                <label for="descripcion">Descripción</label>
                <textarea name="descripcion">{{ old('descripcion', $producto->descripcion ?? '') }}</textarea>

                <label for="precio">Precio</label>
                <input type="text" name="precio" value="{{ old('precio', $producto->precio ?? '') }}" />

                <label for="stock">Stock</label>
                <input type="number" name="stock" value="{{ old('stock', $producto->stock ?? '') }}" />

                <label for="categoria">Categoría</label>
                <select name="categoria">
                    @foreach ($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ old('categoria', $producto->categoria_id ?? '') == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->nombre }}
                    </option>
                    @endforeach
                </select>

                <label for="imagen">Imagen</label>
                @if(isset($producto) && $producto->imagen)
                <img src="{{ asset('storage/' . $producto->imagen) }}" class="thumb" />
                @endif
                <input type="file" name="imagen" />

                <input type="submit" value="Guardar" />
            </form>
        </div>




        @show
    </main>


    @include('components.footer')