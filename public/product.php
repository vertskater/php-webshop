<?php
require  dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;
$product_id = $_GET['id'] ?? null;

$product = $shop->getProducts()->fetchById($product_id);
$title = 'Product - ' . $product['name'];
$navigation = $shop->getCategories()->getNavigation();

Renderer::render(ROOT_PATH . '/public/views/single-product.view.php', [
	'title' => $title,
	'product' => $product,
	'navigation' => $navigation
]);

