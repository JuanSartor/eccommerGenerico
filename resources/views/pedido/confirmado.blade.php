<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    @include('components.header')

    <main class="container-gestor">
        @section('content')

        @if(session()->has('pedido') && $pedido)

        <br/>
        <h3>Datos del pedido:</h3>

        <p>Número de pedido: {{ $pedido->id }}</p>
        <p>Total a pagar: {{ $pedido->costo_productos + $pedido->costo_envio }} $</p>

        <h3>Productos:</h3>
        <table>
            <tr>
                <th>Imagen</th>
                <th>Nombre</th>
                <th>Precio</th>
                <th>Unidades</th>
                <th>Total</th>
            </tr>
            @foreach ($pedido->productos as $producto)
            <tr>
                <td>
                    @if ($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" class="img_carrito" />
                    @else
                    <img src="{{ asset('img/camiseta.png') }}" class="img_carrito" />
                    @endif
                </td>
                <td>{{ $producto->nombre }}</td>
                <td>{{ $producto->precio }}</td>
                <td>{{ $producto->pivot->unidades }}</td>   
                <td>{{ $producto->pivot->unidades * $producto->precio }}</td>  
            </tr>
            @endforeach

            @if($pedido->envio->tipo_envio !='coordinarEnvio')
            <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold;">
                    Costo de envio:  {{$pedido->costo_envio}} 
                </td>
            </tr>
            @endif

            <tr style="height: 70px;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style="font-weight: bold; font-size: 20px;">
                    Total a pagar: {{ $pedido->costo_productos + $pedido->costo_envio }} $
                </td>
            </tr>


        </table>



        <br>

        <h4>Seleccione metodo de pago:</h4>



        <label>
            <input checked="true" type="radio" name="tipo_pago" value="mercadopago" > Mercado Pago
        </label>

        <label>
            <input type="radio" name="tipo_pago" value="transferencia" > Transferencia Bancaria
        </label>



        <button id="btn-pagar" class="btn btn-secondary">Pagar</button>



        @else
        <h1>Tu pedido NO ha podido procesarse</h1>
        @endif


    </main>


    @include('components.footer')





    <!-- Modal de transferencia -->
    <div class="modal fade" id="confirmModal" tabindex="-1" aria-labelledby="confirmModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmModalLabel">Tansferencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Pago por transferencia
                </div>
                <div class="modal-footer">

                    <p>
                        Debera realizar la transferencia a la siguiente cuenta:
                        XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX


                        Por favor envie el comprobante al siguiente correo: asddasda@gmail.com
                    </p>




                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>


                    <a href="{{ route('pago.transferencia', $pedido->id) }}" class="btn btn-danger">Continuar</a>

                </div>
            </div>
        </div>
    </div>



    <script>
// Seleccionamos el botón por su ID
document.getElementById("btn-pagar").addEventListener("click", function () {
    const seleccionado = document.querySelector('input[name="tipo_pago"]:checked');

    if (seleccionado.value == "transferencia") {

        const modal = new bootstrap.Modal(document.getElementById("confirmModal"));
        modal.show();

    } else {

        // llamo al metodo pagar por mercadopago

        window.location.href = "{{ route('pago.mercadopago', $pedido->id) }}";


    }

});
    </script>