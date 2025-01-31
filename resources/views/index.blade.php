<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')
    {{--
    el sidebar por ahora lo dejo comentado xq no voy a hacer una barra lateral
    @include('components.sidebar')
    --}}



    <main>
        @section('content')
        @include('producto.destacados')
        @show
    </main>



    @include('components.footer')



