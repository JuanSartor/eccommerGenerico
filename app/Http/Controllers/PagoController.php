<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
use MercadoPago\Shipments;
use App\Models\Pago;
use App\Models\Pedido;

class PagoController extends Controller {

    public function pagoPorTransferencia($idPedido) {
        // ahora registro el tipo de pago, seteo el estado del pedido, el tipo de pago y el pago
        // por ultimo lo redirijo a la pagina de detalle pedido

        $pagoTransferencia = new Pago();
        $pagoTransferencia->id_pedido = $idPedido;
        $pagoTransferencia->tipo_pago = "transferencia";
        $pagoTransferencia->save();

        $pedido = Pedido::findOrFail($idPedido);
        $pedido->estado = "esperandoConfirmacion";
        $pedido->save();

        return redirect()->route('pedido.detalle', $pedido->id)
                        ->with('success', 'El estado del pedido ha sido actualizado.');
    }

    public function pagoMercadoPago($id) {


        // Autenticación con las credenciales
        SDK::setAccessToken(config('services.mercadopago.access_token'));

        // Crear una preferencia de pago
        $preference = new Preference();

        // Crear un ítem en la preferencia
        $item = new Item();
        $item->title = 'Nombre del producto';
        $item->quantity = 1;
        $item->unit_price = 100.00;
        $preference->items = [$item];

        // Configurar el envío
        /* $shipments = new Shipments();
          $shipments->mode = 'me2'; // 'me2' para MercadoEnvíos
          $shipments->dimensions = '30x30x30,500'; // Formato: AltoxAnchoxLargo,Peso en gramos
          $shipments->default_shipping_method = 73328; // ID del método de envío
          $shipments->zip_code = '1000'; // Código postal de origen
          $preference->shipments = $shipments; */

        // Guardar y obtener la URL de pago
        $preference->save();

        // guardo el init_point en la tabla pago

        $pagoMercadopago = new Pago();
        $pagoMercadopago->id_pedido = $id;
        $pagoMercadopago->tipo_pago = "mercadopago";
        $pagoMercadopago->init_point_mercadopago = $preference->init_point;
        $pagoMercadopago->save();

        $pedido = Pedido::findOrFail($id);
        $pedido->estado = "esperandoConfirmacion";
        $pedido->save();

        return redirect()->route('pedido.detalle', $id)
                        ->with('success', 'El estado del pedido ha sido actualizado.');
    }
}
