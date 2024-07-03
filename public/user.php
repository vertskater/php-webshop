<?php

require dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;

$title = 'User - ' . $_SESSION['username'] ?? 'Profile';
$user_id = $_SESSION['id'] ?? null;
$navigation = $shop->getCategories()->getNavigation();
$user = $shop->getUsers()->fetchUserById($user_id);
if(!$user) {
	Renderer::redirect('/index.php');
}

Renderer::render(ROOT_PATH . '/public/views/user.view.php', [
	'title' => $title,
	'navigation' => $navigation,
	'count' => $count,
	'user' => $user
]);