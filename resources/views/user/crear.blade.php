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
            <form action="{{ isset($usuario) ? route('guardar', $usuario->id) : route('guardar') }}" method="POST" enctype="multipart/form-data">
                @csrf

                @if(isset($usuario))
                <input type="hidden" name="id" value="{{ $usuario->id }}">
                @endif
                <input type="hidden" name="bandera" value="1">




                <label for="name">Nombre</label>
                <input type="text" required name="name" value="{{ old('name', $usuario->name ?? '') }}" />

                <label for="surname">Apellido</label>
                <input type="text" required name="surname" value="{{ old('surname', $usuario->surname ?? '') }}" />

                <label for="email">Email</label>
                <input type="email" required name="email" value="{{ old('email', $usuario->email ?? '') }}" />

                <label for="password">Contraseña</label>
                <input type="password" required name="password" value="{{ old('email', $usuario->password ?? '') }}" />

                <label for="password_confirmation">Repetir contraseña</label>
                <input type="password" name="password_confirmation" required/>



                <label for="rol">Rol</label>
                <select name="role">
                    @if (isset($usuario))
                    @if ($usuario->rol ==='administrador')
                    <option selected value="administrador">
                        Administrador
                    </option>
                    <option value="normal">
                        Normal
                    </option>
                    @else ($usuario->rol ==='normal')
                    <option  value="administrador">
                        Administrador
                    </option>
                    <option selected value="normal">
                        Normal
                    </option>
                    @endif
                    @else
                    <option selected value="administrador">
                        Administrador
                    </option>
                    <option value="normal">
                        Normal
                    </option>
                    @endif

                </select>




                <input type="submit" value="Guardar" />
            </form>
        </div>





    </main>


    @include('components.footer')