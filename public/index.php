<?php

require  dirname(__DIR__) . '/src/bootstrap.php';

use Cm\Shop\Helper\Renderer;
const TEMPLATE_NAME = 'index';

$products = $shop->getProducts()->fetchAll();
$navigation = $shop->getCategories()->getNavigation();
$title = 'Webshop - Homepage';
//$header_img = $shop->getImages()->getHeaderImage(TEMPLATE_NAME)[0] ?? '';
//TODO: Change to database call
//$header_title = 'Welcome to our Store';

Renderer::render(ROOT_PATH . '/public/views/index.view.php', [
	'title' => $title,
	'navigation' => $navigation,
	'products' => $products,
	'count' => $count
]);

