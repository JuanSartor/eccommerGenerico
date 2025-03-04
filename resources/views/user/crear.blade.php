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

    <main class="container-gestor">



        <h1>{{ isset($usuario) ? "Editar usuario $usuario->nombre" : "Crear nuevo usuario" }}</h1>

        <div class="form_container" style="width: 100%;">
            <form action="{{ isset($usuario) ? route('producto.guardar', $usuario->id) : route('producto.guardar') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(isset($usuario))
                <input type="hidden" name="id" value="{{ $usuario->id }}">
                @endif




                <label for="name">Nombre</label>
                <input type="text" required name="name" value="{{ old('name', $usuario->name ?? '') }}" />

                <label for="surname">Apellido</label>
                <input type="text" required name="surname" value="{{ old('surname', $usuario->surname ?? '') }}" />


                <label for="rol">Rol</label>
                <select name="role">

                    <option value="administrador">
                        Administrador
                    </option>
                    <option value="normal">
                        Normal
                    </option>

                </select>




                <input type="submit" value="Guardar" />
            </form>
        </div>





    </main>


    @include('components.footer')