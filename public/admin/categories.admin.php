<?php

require  dirname(__DIR__, 2) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;

$categories = $shop->getCategories()->getAll();
$title = 'Dashboard - Categories';

Renderer::render('./views/categories.admin.view.php', [
	'navigation' => ADMIN_NAV,
	'title' => $title,
	'categories' => $categories
], '/public/admin/views/layout/admin.main.php');



