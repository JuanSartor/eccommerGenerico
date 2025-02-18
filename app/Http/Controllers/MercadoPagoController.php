<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;
use MercadoPago\Shipments;

class MercadoPagoController extends Controller {

    public function createPreference() {


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
        $shipments = new Shipments();
        $shipments->mode = 'me2'; // 'me2' para MercadoEnvíos
        $shipments->dimensions = '30x30x30,500'; // Formato: AltoxAnchoxLargo,Peso en gramos
        $shipments->default_shipping_method = 73328; // ID del método de envío
        $shipments->zip_code = '1000'; // Código postal de origen
        $preference->shipments = $shipments;

        // Guardar y obtener la URL de pago
        $preference->save();

        dd($preference);
    }
}
