<!DOCTYPE html>
<html>

    <body>
        <h1>Metodo de pago {{ $datos['tipo_pago'] }}</h1>

        <h3>Confirmacion de pago del pedido numero: {{$datos['idpedido']}}</h3>




        <table>
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Stock</th>
                    <th>Cantidad Vendida</th>
                </tr>
            </thead>
            <tbody>
                @foreach($datos['productos'] as $producto)
                <tr>
                    <td>{{ $producto->nombre }}</td>
                    <td>{{ $producto->stock }}</td>
                    <td>{{ $producto->cantidad_vendido }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>



    </body>
</html>