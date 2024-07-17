<?php
require dirname(__DIR__) . '/../src/bootstrap.php';
use Cm\Shop\Helper\Renderer;

if($shop->getSession()->role !== 'admin' or empty($shop->getSession()->role)) {
	Renderer::redirect('/index.php');
}

$user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);
$success = false;
try {
	if($user_id) {
		$success = $shop->getUsers()->deleteUser($user_id);
	}
	if($success) {
		Renderer::redirect('/admin/users.admin.php', ['success' => 'user successfully deleted']);
	}
}catch (Exception $e) {
	Renderer::redirect('/admin/users.admin.php', ['error' => 'user could not be deleted']);
}




