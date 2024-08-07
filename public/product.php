<?php
require  dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;
use Cm\Shop\Helper\ShopHandler;

$product_id = filter_input(INPUT_GET, 'id') ?? null;
$product = $shop->getProducts()->fetchById($product_id);
$title = 'Product - ' . $product['name'];
$navigation = $shop->getCategories()->getNavigation();
$info = [];
if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$info = (new ShopHandler($shop))->handleAddToCartRequest()->getErrors();
	$count = $shop->getShoppingCart()->cartItemsCount($shop->getSession()->id);
}


Renderer::render(ROOT_PATH . '/public/views/single-product.view.php', [
	'title' => $title,
	'product' => $product,
	'navigation' => $navigation,
	'info' => $info,
	'count' => $count
]);

