<?php
require  dirname(__DIR__, 2) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;
use Cm\Shop\Helper\Validate;

$cat_id = filter_input(INPUT_GET, 'cat_id', FILTER_VALIDATE_INT);
$title = "Add new category";
$category = [];
$errors['name'] = '';
$errors['description'] = '';

if($cat_id) {
	$titel = 'Edit category';
	$category = $shop->getCategories()->getCategoryById($cat_id);
}

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$category['cat_id'] = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
	$category['name'] = filter_input(INPUT_POST, 'name');
	$category['description']  = filter_input(INPUT_POST, 'description');
	$category['nav'] = filter_input( INPUT_POST, 'nav', FILTER_VALIDATE_BOOL ) ? 1 : 0;

	//Error handling
	$errors['name'] = Validate::validate_is_string($category['name'], 3, 50) ? '' : 'Name must have at least 3 and max 50 chars.';
	$errors['description'] = Validate::validate_is_string($category['description'], 10, 200) ? '' : 'Description must have at least 10 and max 100 Chars.';

	$error = implode($errors);
	if($error === '') {
		if(!empty($category['cat_id'])) {
			$shop->getCategories()->updateCategory($category);
		}else {
			unset($category['cat_id']);
			$shop->getCategories()->setNewCategory($category);
		}
		Renderer::redirect('/admin/categories.admin.php');
	}
}


Renderer::render('./views/edit-category.view.php', [
	'title' => $title,
	'navigation' => ADMIN_NAV,
	'category' => $category,
	'errors' => $errors
], '/public/admin/views/layout/admin.main.php');
