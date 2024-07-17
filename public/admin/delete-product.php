<?php
require dirname(__DIR__) . '/../src/bootstrap.php';
use Cm\Shop\Helper\Renderer;

if($shop->getSession()->role !== 'admin' or empty($shop->getSession()->role)) {
	Renderer::redirect('/index.php');
}

$prod_id = filter_input(INPUT_GET, 'prod_id', FILTER_VALIDATE_INT);
$success = false;
$image_id = 0;

try {
	if($prod_id) {
		$image_id = $shop->getProducts()->getImageId($prod_id);
		$image = $shop->getImages()->getImageById($image_id);
		unlink(UPLOAD_DIR . $image['filename']);
		$success = $shop->getProducts()->deleteProduct($prod_id);
		if($success) $shop->getImages()->deleteImage($image_id);
	}
	if($success) {
		Renderer::redirect('/admin/products.admin.php', ['success' => 'product successfully deleted']);
	}
}catch(Exception $e) {
	Renderer::redirect('/admin/products.admin.php', ['error' => 'product could not be deleted']);

}

