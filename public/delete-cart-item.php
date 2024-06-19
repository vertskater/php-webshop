<?php
require dirname(__DIR__) . '/src/bootstrap.php';

$cart_id = filter_input(INPUT_GET, 'cart_id', FILTER_VALIDATE_INT );
$shop->getShoppingCart()->deleteItem($cart_id);
header('LOCATION: /cart.php');

