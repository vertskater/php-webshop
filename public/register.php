<?php
require dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;
use Cm\Shop\Helper\Validate;
use Cm\Shop\Config\Config;

$title = "New Account";
$navigation = $shop->getCategories()->getNavigation();
$errors = [];
$form_data = [];

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$form_data['firstname'] = filter_input(INPUT_POST, 'firstname');
	$form_data['lastname'] = filter_input(INPUT_POST, 'lastname');
	$form_data['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$form_data['password'] = filter_input(INPUT_POST, 'password');

	$errors['password_match'] = filter_input(INPUT_POST, 'password') === filter_input(INPUT_POST, 'password-confirm') ? '' : 'Passwords do not match';
	$errors['password'] = Validate::validatePassword($form_data['password']) ? '' : 'Password need to have min 8 charakters, and include Upper-, Lower-Case and special chars.';
	$errors['email'] = $form_data['email'] ? '' : 'E-Mail-Address not valid';
	$errors['firstname'] = Validate::validate_is_string($form_data['firstname'], 3, 50) ? '' : 'Firstname need to have min 3 and max 50 chars';
	$errors['lastname'] = Validate::validate_is_string($form_data['lastname'], 3, 50) ? '' : 'Lastname need to have min 3 and max 50 chars';
	$errors['email_exists'] = $shop->getUsers()->emailExists($form_data['email']) ? 'E-Mail-Address already exists' : '';
	$valid = implode($errors);
	if(!$valid) {
		$form_data['role_id'] = $shop->getRoles()->getRoleId(Config::DEFAULT_USER_ROLE);
		$shop->getUsers()->registerUser($form_data);
		header('LOCATION: /login.php?success=1');
	}
 }

Renderer::render(ROOT_PATH . '/public/views/register.view.php', [
	'title' => $title,
	'navigation' => $navigation,
	'count' => $count,
	'errors' => $errors,
	'data' => $form_data
]);

