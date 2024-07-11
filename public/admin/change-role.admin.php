<?php

require  dirname(__DIR__, 2) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;

$user_id = filter_input(INPUT_GET, 'user_id');
$role_id = filter_input(INPUT_POST, 'user-role', FILTER_VALIDATE_INT);

if($user_id && $role_id) {
	$shop->getUsers()->changeRole($user_id, $role_id);
}

Renderer::redirect('/admin/users.admin.php');
