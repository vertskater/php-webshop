<?php
require dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;
use Cm\Shop\Helper\Validate;
use Cm\Shop\Helper\Helper;

$title = 'Login - Webshop';
$navigation = $shop->getCategories()->getNavigation();
$info['error'] = null;
$info['success'] = filter_input(INPUT_GET, 'success') ===  '1' ? 'Successfully registered, pls log in' : '';

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
			$current_cart_items = $shop->getShoppingCart()->fetchAllCartEntriesByUser($user['id']);
			$new_cart_items = Helper::combineCart($current_cart_items, $shop->getSession()->cart);
			if(!empty($new_cart_items)) {
				foreach ($new_cart_items as $cart_item) {
					$shop->getShoppingCart()->deleteItem($cart_item['product_id'], $cart_item['user_id']);
					$shop->getShoppingCart()->addToCart($cart_item['product_id'], $cart_item['quantity']);
				}
			}
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
	'error' => $info['error'],
	'success' => $info['success']
]);
