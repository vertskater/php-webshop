<?php

require  dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;


$title = "Checkout";
$navigation = $shop->getCategories()->getNavigation();
$user_id = $shop->getSession()->id;
$info = '';
$success = false;

if(!$user_id) {
	Renderer::redirect('/login.php');
}

$products = $shop->getShoppingCart()->fetchCartItems($user_id);
if($products) {
	try {
		foreach ($products as $product) {
			$success = $shop->getSoldProducts()->saveProduct(['product_id' => $product['product_id'], 'quantity' => $product['quantity'], 'user_id' => $product['user_id']]);
		}
		if($success) {
			foreach ($products as $product) {
				$shop->getShoppingCart()->deleteItem($product['product_id'], $product['user_id']);
			}
		}
		$count = $shop->getShoppingCart()->cartItemsCount($user_id);
		$info = 'Thank you for your purchase!';
	}catch (PDOException $e) {
		$info = $e->getMessage();
	}
}

Renderer::render(ROOT_PATH . '/public/views/checkout.view.php',[
	'title' => $title,
	'navigation' => $navigation,
	'count' => $count,
	'info' => $info
]);