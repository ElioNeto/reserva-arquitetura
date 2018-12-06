<?php
// Consideramos que já existe um autoloader compatível com a PSR-4 registrado

use PHPSC\PagSeguro\Credentials;
use PHPSC\PagSeguro\Environments\Sandbox;
use PHPSC\PagSeguro\Customer\Customer;
use PHPSC\PagSeguro\Items\Item;
use PHPSC\PagSeguro\Requests\Checkout\CheckoutService;

$credentials = new Credentials(
    'netoo.elio@hotmail.com', 
    '869C12A631C54697B11F69F53BBEBCF5',
    new Sandbox()
);

try {
    $service = new CheckoutService($credentials); // cria instância do serviço de pagamentos
    
    $checkout = $service->createCheckoutBuilder()
                        ->addItem(new Item(1, 'Televisão LED 500', 8999.99))
                        ->addItem(new Item(2, 'Video-game mega ultra blaster', 799.99))
                        ->getCheckout();
    
    $response = $service->checkout($checkout);
    
    //Se você quer usar uma url de retorno
    //$checkout->setRedirectTo( "http://seu_dominio/uri/retorno" );
    
    //Se você quer usar uma url de notificação
   // $checkout->setNotificationURL( "http://seu_dominio/admin/transacao/notificacao" );

    header('Location: ' . $response->getRedirectionUrl()); // Redireciona o usuário
} catch (Exception $error) { // Caso ocorreu algum erro
    echo $error->getMessage(); // Exibe na tela a mensagem de erro
}