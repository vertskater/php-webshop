<?php
require dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;
use Cm\Shop\Config\Config;
use Cm\Shop\Helper\Helper;

$info = [];
$quantity = filter_input(INPUT_POST, 'quantity', FILTER_VALIDATE_INT, [
	'options' => [
		'min_range' => 1,
		'max_range' => 5
	]
]);

$info['error'] = $quantity === false ? 'You can order max 5 pieces per product.' : '';
$product_id = filter_input(INPUT_POST, 'product_id', FILTER_VALIDATE_INT );

if($quantity && $product_id) {
	$shop->getShoppingCart()->setNewAmount($quantity, $product_id);
	$count = $shop->getShoppingCart()->cartItemsCount($_SESSION['id'] ?? $shop->getSession()->id);
	$info['success'] = 'Quantity successfully changed';
}

$price['total_net'] = 0;
$price['ust'] = 0;

$cart_items = $shop->getShoppingCart()->fetchCartItems($_SESSION['id'] ?? $shop->getSession()->id);
if(!empty($shop->getSession()->cart)) {
	$cart_items = $shop->getSession()->cart;
	$cart_items = array_map(function ($cart_item) use ($shop){
		$cart_item['id'] = $shop->getSession()->id;
		$product = $shop->getProducts()->fetchById($cart_item['product_id']);
		$cart_item['name'] = $product['name'];
		$cart_item['price'] = $product['price'];
		$cart_item['username'] = 'Guest User';
		return $cart_item;
	}, $cart_items);
}

$count = !empty($_SESSION['id']) ? $shop->getShoppingCart()->cartItemsCount($_SESSION['id']) : (new Helper($shop))->sumCartItemsQuantity($shop->getSession()->cart);
$navigation = $shop->getCategories()->getNavigation();
$title = "$count - Products in shopping cart";
foreach ($cart_items as $item) {
	$price['total_net'] += (($item['quantity'] * $item['price']) * 100 ) / 120;
}

$price['ust'] = $price['total_net'] * Config::UST;
$price['total_gross'] = $price['total_net'] + $price['ust'];



Renderer::render(ROOT_PATH . '/public/views/cart.view.php', [
	'title' => $title,
	'navigation' => $navigation,
	'items' => $cart_items,
	'count' => $count,
	'price' => $price,
	'info' => $info
]);
