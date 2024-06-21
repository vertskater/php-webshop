<?php
require dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;
use Cm\Shop\Helper\Validate;

$title = 'Login - Webshop';
$navigation = $shop->getCategories()->getNavigation();
$info['error'] = null;

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$password = filter_input(INPUT_POST, 'password');
	if(!$email) {
		$info['error'] = 'E-Mail or Password not valid (Email)';
	}
	$info['error'] = Validate::validatePassword($password) ? '' : 'E-Mail or Password not valid (Password)';
	if($info['error'] === '') {
		$user = $shop->getUsers()->login($email, $password);
		if($user){
			$shop->getSession()->createSession($user);
			Renderer::redirect('/index.php');
		}else {
			$info['error'] = 'login failed';
		}
	}
}



Renderer::render(ROOT_PATH . '/public/views/login.view.php', [
	'title' => $title,
	'navigation' => $navigation,
	'count' => $count,
	'email' => $email ?? '',
	'error' => $info['error']
]);
