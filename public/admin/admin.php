<?php

require  dirname(__DIR__, 2) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;

if($shop->getSession()->role !== 'admin' or empty($shop->getSession()->role)) {
	Renderer::redirect('../../index.php');
}

$logged_in_user = null;
$user_id = $shop->getSession()->id ?? null;
if($user_id) {
	$logged_in_user = $shop->getUsers()->fetchUserById($user_id);
}

$products_in_store = json_encode($shop->getProducts()->fetchStoredProducts());
$title = 'Admin-Dashboard';

Renderer::render(ROOT_PATH . '/public/admin/views/admin.view.php', [
	'title' => $title,
	'navigation' => ADMIN_NAV,
	'user' => $logged_in_user,
	'stored_products' => $products_in_store
 ], '/public/admin/views/layout/admin.main.php');