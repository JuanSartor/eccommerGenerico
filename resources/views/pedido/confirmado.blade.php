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
                <td id="costo_envio_col" style="font-weight: bold;">
                    @php
                    $i = 0; // Inicializamos el contador
                    @endphp

                    @foreach ($opciones_envio as $envio)
                    Costo de envio:  {{$envio['total_cost']}}

                    @php
                    $i++; // Incrementamos el contador
                    @endphp
                    @endforeach
                </td>
            </tr>
            @endif

            <tr style="height: 70px;">
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td id="costo_total_col" style="font-weight: bold; font-size: 20px;">
                    @php
                    $i = 0; // Inicializamos el contador
                    @endphp

                    @foreach ($opciones_envio as $envio)
                    Total a pagar:  $ {{ $pedido->costo_productos + $envio['total_cost'] }}   

                    @php
                    $i++; // Incrementamos el contador
                    @endphp
                    @endforeach

                </td>
            </tr>


        </table>



        <br>

        @if($pedido->envio->tipo_envio !='coordinarEnvio')
        <h4>Envio:</h4>

        @php
        $i = 0; // Inicializamos el contador
        @endphp

        @foreach ($opciones_envio as $envio)
        <div class="row">
            <div class="col-sm-12 d-flex align-items-center">
                <input type="radio" id="envio_{{ $envio['id'] }}" name="envio_id" value="{{ $envio['id'] }}" 
                       @if($i == 0) checked @endif>
                <p class="mb-0 ms-1" id="p_{{ $envio['id'] }}">{{ $envio['name'] }}, precio total: ${{ number_format($envio['total_cost'], 2, ',', '.') }}</p>

            </div>
        </div>
        
          <div class="col-sm-12 d-flex align-items-center">
                <input type="radio" id="envio_5" name="envio_id" value="5"  >
                <p class="mb-0 ms-1" id="p_5"> precio total: $5</p>

            </div>


        @php
        $i++; // Incrementamos el contador
        @endphp
        @endforeach

        @endif


        <br>
        <h4>Seleccione metodo de pago:</h4>



        <label>
            <input checked="true" type="radio" name="tipo_pago" value="mercadopago" > Mercado Pago
        </label>

        <label>
            <input type="radio" name="tipo_pago" value="transferencia" > Transferencia Bancaria
        </label>



        <button id="btn-pagar" class="btn btn-secondary">Generar Orden</button>



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






// Espera a que todo el documento esté listo
document.addEventListener('DOMContentLoaded', function () {
    // Obtén todos los radio buttons de envío
    const radios = document.querySelectorAll('input[name="envio_id"]');

    // Añade el evento change a cada radio button
    radios.forEach(function (radio) {
        radio.addEventListener('change', function () {

            // obtengo el id del radio
            const costoEnvio = this.value;
            // con el id obtenido del radio lo concateno y obtengo el texto del parrafo
            const texto = document.getElementById('p_' + costoEnvio).textContent;
            // elimino el texto y me quedo con el precio solamente
            const precio = texto.match(/\$(\d{1,3}(?:\.\d{3})*(?:,\d{2})?)/);
            const soloPrecio = precio[0].replace('$', '').replace('.', '').replace(',', '.');


            // cambio el valor que se muestra del precio del envio en base a cuando cambia el radio
            const costoEnvioCol = document.getElementById('costo_envio_col');
            costoEnvioCol.innerText = 'Costo de envio: ' + soloPrecio;


            // obtengo el valor del costo total de los productos pasado en blade
            /////////////////////
            ////////////////////
            // NO DEBO IDENTAR con el atajo del teclado
            //  EL CODIGO XQ GENERA UN BUG, SE SEPARAN LA FLECHITA Y QUEDA ESPACIO Y LO INTERPRETA MAL
            //////////////////////
            ///////////////////
            var costoProductos = @json($pedido->costo_productos);
                    // sumo el valor nuevo seleccionado mas el costo total de los productos
                    const costoTotal = parseFloat(soloPrecio) + parseFloat(costoProductos);
            const costoTotalRedondeado = Math.round(costoTotal * 100) / 100; // Redondear a 2 decimales

            // Actualiza el costo total en la página
            const costoTotalCol = document.getElementById('costo_total_col');
            costo_final=costoTotalRedondeado.toFixed(2);
            costoTotalCol.innerText = ' Total a pagar:  $ ' + costo_final; //


                 var idpedido = @json($pedido->id);
            // acutalizo el costo de envio en la base de datos, en base a la opcion seleccionada
            fetch('{{ url("/actualizar-costo-envio") }}', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                body: JSON.stringify({costo_envio: soloPrecio, id_pedido:idpedido})
            });


        });
    });
});


    </script>