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
	$form_data['gender'] = filter_input(INPUT_POST, 'gender');
	$form_data['firstname'] = filter_input(INPUT_POST, 'firstname');
	$form_data['lastname'] = filter_input(INPUT_POST, 'lastname');
	$form_data['email'] = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
	$form_data['birthdate'] = filter_input(INPUT_POST, 'birthdate');
	$form_data['password'] = filter_input(INPUT_POST, 'password');
	$default_profile_img = $form_data['gender'] === 'male' ? Config::PROFILE_IMAGE_PLACEHOLDER_MALE : Config::PROFILE_IMAGE_PLACEHOLDER_FEMALE;
	if($default_profile_img) {
		$form_data['profile_pic_id'] = $shop->getImages()->getProfilePicId($default_profile_img);
	}else {
		$form_data['profile_pic_id'] = $shop->getImages()->getProfilePicId(Config::PROFILE_IMAGE_PLACEHOLDER);
	}

	$errors['password_match'] = filter_input(INPUT_POST, 'password') === filter_input(INPUT_POST, 'password-confirm') ? '' : 'Passwords do not match';
	$errors['password'] = Validate::validatePassword($form_data['password']) ? '' : 'Password need to have min 8 charakters, and include Upper-, Lower-Case and special chars.';
	$errors['email'] = $form_data['email'] ? '' : 'E-Mail-Address not valid';
	$errors['birthdate'] = $form_data['birthdate'] ? '' : 'Please fill in a birthdate';
	$errors['firstname'] = Validate::validate_is_string($form_data['firstname'], 3, 50) ? '' : 'Firstname need to have min 3 and max 50 chars';
	$errors['lastname'] = Validate::validate_is_string($form_data['lastname'], 3, 50) ? '' : 'Lastname need to have min 3 and max 50 chars';
	$errors['email_exists'] = $shop->getUsers()->emailExists($form_data['email']) ? 'E-Mail-Address already exists' : '';
	$errors['gender'] = Validate::validate_gender($form_data['gender']) ? '' : 'Please fill in a valid gender';

	$valid = implode($errors);
	if(!$valid) {
		$form_data['role_id'] = $shop->getRoles()->getRoleId(Config::DEFAULT_USER_ROLE);
		$shop->getUsers()->registerUser($form_data);
		Renderer::redirect('/login.php', ['success' => 1]);
	}
 }

Renderer::render(ROOT_PATH . '/public/views/register.view.php', [
	'title' => $title,
	'navigation' => $navigation,
	'count' => $count,
	'errors' => $errors,
	'data' => $form_data
]);

