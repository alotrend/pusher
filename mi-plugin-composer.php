<?php
/*
Plugin Name: Mi Plugin Composer
Description: Un plugin personalizado usando Composer
Version: 1.0
Author: Tu Nombre
*/

// Incluir Composer autoload
if (file_exists(__DIR__ . '/vendor/autoload.php')) {
    require_once __DIR__ . '/vendor/autoload.php';
}

use Twilio\Rest\Client;

function enviar_notificacion_woocommerce($order_id) {
    $account_sid = 'TU_ACCOUNT_SID';
    $auth_token = 'TU_AUTH_TOKEN';
    $twilio_number = 'TU_TWILIO_NUMBER';
    $cliente_numero = 'NUMERO_DEL_CLIENTE'; // Ajusta este número según tu necesidad

    $client = new Client($account_sid, $auth_token);
    $message = "Tu pedido #$order_id ha sido recibido.";

    $client->messages->create(
        $cliente_numero,
        array(
            'from' => $twilio_number,
            'body' => $message
        )
    );
}
add_action('woocommerce_thankyou', 'enviar_notificacion_woocommerce', 10, 1);
