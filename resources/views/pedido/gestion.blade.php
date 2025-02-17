<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('components.header')

    <main class="container-gestor">
        @section('content')

        @if( Auth::user()->rol === 'admin')
        <h1>Gestionar pedidos</h1>
        @else
        <h1>Mis pedidos</h1>
        @endif

        <table>
            <tr>
                <th>Nº Pedido</th>
                <th>Coste</th>
                <th>Fecha</th>
                <th>Estado</th>
            </tr>
            @foreach ($pedidos as $pedido)
            <tr>
                <td>
                    <a href="{{ route('pedido.detalle', $pedido->id) }}">{{ $pedido->id }}</a>
                </td>
                <td>
                    {{ $pedido->coste }} $
                </td>
                <td>
                    {{ $pedido->fecha }}
                </td>
                <td>
                    {{ $pedido->mostrarEstado($pedido->estado) }}
                </td>
            </tr>
            @endforeach
        </table>



        @show
    </main>


    @include('components.footer')
