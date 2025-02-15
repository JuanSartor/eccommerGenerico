<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <style>


        input,textArea,select{
            width: 50% !important;
        }


        input[type="submit"]{
            width: 15% !important;
            margin:20px auto;
        }
    </style>



    @include('components.header')

    <main style="margin-left: 20px;">
        @section('content')


        <h1>{{ isset($producto) ? "Editar producto $producto->nombre" : "Crear nuevo producto" }}</h1>

        <div class="form_container" style="width: 100%;">
            <form action="{{ isset($producto) ? route('producto.guardar', $producto->id) : route('producto.guardar') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(isset($producto))
                <input type="hidden" name="id" value="{{ $producto->id }}">
                @endif
                <div style="display: flex;">
                    <div style="width: 50%;">


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


                    </div>

                    <div style="width: 50%;">
                        <br>
                        <h2 style="text-decoration: underline;">Datos necesarios para configurar el envio</h2>


                        <label for="alto">Alto(cm)</label>
                        <input type="text" name="alto" value="{{ old('alto', $producto->alto ?? '') }}" />

                        <label for="ancho">Ancho(cm)</label>
                        <input type="text" name="ancho" value="{{ old('ancho', $producto->ancho ?? '') }}" />

                        <label for="largo">Largo(cm)</label>
                        <input type="text" name="largo" value="{{ old('largo', $producto->largo ?? '') }}" />

                        <label for="peso">Peso(gramos)</label>
                        <input type="text" name="peso" value="{{ old('peso', $producto->peso ?? '') }}" />


                    </div>

                </div>
                <input type="submit" value="Guardar" />
            </form>
        </div>




        @show
    </main>


    @include('components.footer')