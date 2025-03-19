<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
use MercadoPago\Payment;
use MercadoPago\Shipments;
use App\Models\Pago;
use App\Models\Pedido;
use Log;

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

        $pedido = Pedido::findOrFail($id);
        // Obtener productos asociados al pedido
        $productos = $pedido->productos;

        // Crear una preferencia de pago
        $preference = new Preference();

        $items = [];

        foreach ($productos as $producto) {
            $item = new Item();
            $item->title = $producto['nombre'];
            $item->quantity = $producto['pivot']['unidades'];
            $item->currency_id = 'ARS';
            $item->unit_price = $producto['precio'];
            $items[] = $item;
        }
        $preference->items = $items;

        // Crear un ítem en la preferencia
        /*    $item = new Item();
          $item->title = 'Nombre del producto';
          $item->quantity = 1;
          $item->unit_price = 100.00;
          $preference->items = [$item];
         */
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
        $pagoMercadopago->pref_id = $preference->id;
        $pagoMercadopago->save();

        $pedido->estado = "esperandoConfirmacion";
        $pedido->save();

        return redirect()->route('pedido.detalle', $id)
                        ->with('success', 'El estado del pedido ha sido actualizado.');
    }

    /**
     * 
     * @param Request $request
     * @return type
     */
    public function handle(Request $request) {


        $paymentId = $request->input('data.id');

// Autenticación de MercadoPago (cargar el SDK de MercadoPago)
        SDK::setAccessToken(config('services.mercadopago.access_token'));

        // Obtener detalles del pago a través de la API de MercadoPago
        $payment = Payment::find_by_id($paymentId);

        // Verificar que la respuesta fue correcta
        if ($payment->status == 'approved') {
            // Aquí puedes hacer algo con los datos del pago
            // Por ejemplo, asociar el pago con tu preferencia:
            // $preferenceId = $payment->preference_id; // Esto es el pref_id de la preferencia que se asocia al pago

            Log::info('Webhook recibido: ', json_decode(json_encode($request["data"]), true));
            Log::info('Webhook recibido: ', json_decode(json_encode($payment), true));

// Luego puedes acceder a la preferencia si lo necesitas
            //  $preference = Preference::find_by_id($preferenceId);
            // Puedes acceder a la preferencia y otros datos como los productos, el monto, etc.
            // Aquí solo mostramos el estado del pago y el nombre del producto
            //  echo "Estado del pago: " . $payment->status;
            // echo "Producto: " . $preference->items[0]->title;
            // Hacer lo que necesites con el pago, como actualizar el estado en tu base de datos
        } else {
            // Si el pago no es exitoso, manejar el error
            // echo "Pago no aprobado. Estado: " . $payment->status;
            // $preferenceId = $payment->preference_id; // Esto es el pref_id de la preferencia que se asocia al pago

            Log::info('Webhook recibido no aceptado: ', json_decode(json_encode($request), true));
            Log::info('Webhook recibido: ', json_decode(json_encode($payment), true));
        }



        return response()->json(['message' => 'Webhook recibido'], 200);
    }
}
