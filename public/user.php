<?php

require dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;
use Cm\Shop\Helper\Helper;
use Cm\Shop\Config\Config;

$title = 'User - ' . $_SESSION['username'] ?? 'Profile';
$user_id = $_SESSION['id'] ?? null;
$navigation = $shop->getCategories()->getNavigation();
$user = $shop->getUsers()->fetchUserById($user_id);
if(!$user) {
	Renderer::redirect('/index.php');
}
$errors = [];
$tmp_path = $_FILES['image']['tmp_name'] ?? null;


if($_SERVER['REQUEST_METHOD'] === 'POST') {
	if(!empty($_FILES['image'])) {
		$profile_img = $_FILES['image'];
		$errors['image'] = $profile_img['error'] === UPLOAD_ERR_INI_SIZE ? 'Image size too big, ' : '';
		if($tmp_path and $profile_img['error'] == UPLOAD_ERR_OK) {
			$type            = mime_content_type( $tmp_path );
			$errors['image'] .= in_array( $type, Config::MEDIA_TYPES ) ? '' : 'Image filetype not allowed, ';

			if ( $errors['image'] === '' ) {
				$save_to = Helper::get_file_path( $profile_img['name'], UPLOAD_DIR );
			}
			if ( ! empty( $save_to ) ) {
				Helper::scale_and_copy( $tmp_path, $save_to );
				$image_id = $shop->getImages()->save( $profile_img['name'], Config::PROFILE_IMG_ALT_TEXT );
				$shop->getUsers()->updateUserProfileImgId( $user['id'], $image_id );
				$user = $shop->getUsers()->fetchUserById( $user_id );
			}
		}
	}
}

$last_purchased = $shop->getSoldProducts()->fetchSoldProducts($user_id);

Renderer::render(ROOT_PATH . '/public/views/user.view.php', [
	'title' => $title,
	'navigation' => $navigation,
	'count' => $count,
	'user' => $user,
	'products' => $last_purchased,
	'upload_errors' => $errors
]);