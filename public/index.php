<?php

require  dirname(__DIR__) . '/src/bootstrap.php';

use Cm\Shop\Helper\Renderer;

$products = $shop->getProducts()->fetchAll();
$navigation = $shop->getCategories()->getNavigation();
$title = 'Webshop - Homepage';

Renderer::render(ROOT_PATH . '/public/views/index.view.php', [
	'title' => $title,
	'navigation' => $navigation,
	'products' => $products
]);

