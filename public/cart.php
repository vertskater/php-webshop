<?php
require dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;
use Cm\Shop\Config\Config;

$price['total_net'] = 0;
$price['ust'] = 0;

$cart_items = $shop->getShoppingCart()->fetchCartItems();
$count_items = $shop->getShoppingCart()->cartItemsCount() ?? 0;
$navigation = $shop->getCategories()->getNavigation();
$title = "$count_items - Products in shopping cart";

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
	'price' => $price
]);
