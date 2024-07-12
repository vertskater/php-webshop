<?php

require  dirname(__DIR__, 2) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;

if($shop->getSession()->role !== 'admin' or empty($shop->getSession()->role)) {
	Renderer::redirect('../../index.php');
}

$title = 'Dashboard - Users';
$role_id = filter_input(INPUT_GET, 'role_id') ? $_GET['role_id'] : '';
$users = $shop->getUsers()->fetchAllUsers();
$roles = $shop->getRoles()->fetchAllRoles();
if(!empty($role_id)) {
	$users = $shop->getUsers()->fetchUserByRole($role_id);
}

Renderer::render('./views/users.admin.view.php', [
	'navigation' => ADMIN_NAV,
	'title' => $title,
	'users' => $users,
	'roles' => $roles,
	'role_id' => $role_id
], '/public/admin/views/layout/admin.main.php');



