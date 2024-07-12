<?php
require  dirname(__DIR__, 2) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;

if($shop->getSession()->role !== 'admin' or empty($shop->getSession()->role)) {
	Renderer::redirect('../../index.php');
}

$cat_id = filter_input(INPUT_GET, 'cat_id', FILTER_VALIDATE_INT);
if(!$cat_id) {
	Renderer::redirect('/admin/admin.php');
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$shop->getCategories()->deleteCategory($cat_id);
	Renderer::redirect('/admin/categories.admin.php');
}

$category = $shop->getCategories()->getCategoryById($cat_id);
$title = 'Delete Category-' . $category['name'];

Renderer::render('./views/delete-category.view.php', [
	'title' => $title,
	'navigation' => ADMIN_NAV,
	'cat_id' => $cat_id,
	'cat_name' => $category['name']
], '/public/admin/views/layout/admin.main.php');