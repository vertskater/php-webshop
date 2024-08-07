<?php

require  dirname(__DIR__, 2) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;

if($shop->getSession()->role !== 'admin' or empty($shop->getSession()->role)) {
	Renderer::redirect('../../index.php');
}

$categories = $shop->getCategories()->getAll();
$cat_id = filter_input(INPUT_GET, 'cat_id');
$title = 'Dashboard - Products';

if($cat_id) {
	$products = $shop->getProducts()->fetchProductsByCategory($cat_id);
}else {
	$products = $shop->getProducts()->fetchAll();
}

Renderer::render('./views/products.admin.view.php', [
	'navigation' => ADMIN_NAV,
	'categories' => $categories,
	'title' => $title,
	'cat_id' => $cat_id,
	'products' => $products
], '/public/admin/views/layout/admin.main.php');



