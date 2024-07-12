<?php
require dirname(__DIR__) . '/../src/bootstrap.php';
use Cm\Shop\Helper\Renderer;

$user_id = filter_input(INPUT_GET, 'user_id', FILTER_VALIDATE_INT);
$success = false;
if($user_id) {
	$success = $shop->getUsers()->deleteUser($user_id);
}
if($success !== false) {
	Renderer::redirect('/admin/users.admin.php', ['success' => 'successfully_deleted']);
}


