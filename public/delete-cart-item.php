<?php
require dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;

$product_id = filter_input(INPUT_GET, 'product_id', FILTER_VALIDATE_INT );
if(empty($_SESSION['id'])) {
	$index = array_key_exists($product_id, $shop->getSession()->cart);
	if($index) unset($_SESSION['cart'][$product_id]);
}else {
	$shop->getShoppingCart()->deleteItem($product_id, $shop->getSession()->id);
}

Renderer::redirect('/cart.php');


