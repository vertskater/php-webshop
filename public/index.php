<?php

require  dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;
const TEMPLATE_NAME = 'index';

$products = $shop->getProducts()->fetchAll();
$navigation = $shop->getCategories()->getNavigation();
$title = 'Webshop - Homepage';

Renderer::render(ROOT_PATH . '/public/views/index.view.php', [
	'title' => $title,
	'navigation' => $navigation,
	'products' => $products,
	'count' => $count
]);

