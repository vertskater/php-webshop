<?php

require  dirname(__DIR__, 2) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;
use Cm\Shop\Helper\Helper;
use Cm\Shop\Config\Config;
use Cm\Shop\Helper\Validate;


if($shop->getSession()->role !== 'admin' or empty($shop->getSession()->role)) {
	Renderer::redirect('/index.php');
}

$product_id = filter_input(INPUT_GET, 'prod_id', FILTER_VALIDATE_INT);
$product = [];
$title = 'Add a new product';
$errors = [
	'name' => '',
	'description' => '',
	'details' => '',
	'price' => '',
	'in_store' => '',
	'category' => '',
	'image' => '',
	'image_alt' => '',
  'user_id' => ''
];

if($product_id) {
	$product = $shop->getProducts()->fetchById($product_id);
	$title = 'Edit product - ' . $product['name'];
}
$categories = $shop->getCategories()->getAll();

if($_SERVER['REQUEST_METHOD'] === 'POST') {
	$price = str_replace('.', '', $_POST['price'] ?? 0);
	$product['product_id'] = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
	$product['name'] = filter_input(INPUT_POST, 'name');
	$product['description'] = filter_input(INPUT_POST, 'description');
	$product['details'] = filter_input(INPUT_POST, 'details');
	$product['price'] = floatval(str_replace(',', '.', $price));
	$product['in_store'] = filter_input(INPUT_POST, 'stored', FILTER_VALIDATE_INT);
	$product['category_id'] = filter_input(INPUT_POST, 'category', FILTER_VALIDATE_INT);
	$product['image_alt'] = filter_input(INPUT_POST, 'alt_text');
	$product['user_id'] = $shop->getSession()->id;

	//Handle Errors
	$errors['name'] = Validate::validate_is_string($product['name'], 3, 100) ? '' : 'Name must have at least 3 and max 100 characters';
	$errors['description'] = Validate::validate_is_string($product['description'], 10, 100) ? '' : 'Description mast have at least 10 and max 100 characters';
	$errors['details'] = Validate::validate_is_string($product['details'], 10) ? '' : 'Details mast have at least 10 characters';
	$errors['price'] = $product['price'] ? '' : 'Price must be in Format 1.000,00';
	$errors['in_store'] =  Validate::validate_is_int($product['in_store']) ? '' : 'Stored Products must be a number without decimals';
	$errors['image_alt'] = Validate::validate_is_string($product['image_alt'], 5, 20) ? '' : 'Alt text must have at least 5 and max 20 characters';
	//Handle-Image-Upload
	$image = $_FILES['image'] ?? '';
	if($image) {
		$errors['image'] = $image['error'] === UPLOAD_ERR_INI_SIZE ? 'Image-size exceeded the upload_max_filesize' : '';
		$tmp_path = $image['tmp_name'];

		if($tmp_path && $image['error'] === UPLOAD_ERR_OK) {
			$type = mime_content_type($tmp_path);
			$errors['image'] .= in_array( $type, Config::MEDIA_TYPES ) ? '' : 'Image filetype not allowed, ';
			if ( $errors['image'] === '' ) {
				$save_to = Helper::get_file_path( $image['name'], UPLOAD_DIR );
			}
			if(!empty($save_to) && $errors['image_alt'] === '') {
				Helper::scale_and_copy( $tmp_path, $save_to );
				$product['image_id'] = $shop->getImages()->save( $image['name'],  $product['image_alt']);
			}
		}
	}
	$error = implode($errors);

	if($error === '' ) {
		unset( $product['image_alt'] );
		if($product['product_id']) {
			if ( empty( $product['image_id'] ) ) {
				$product['image_id'] = $shop->getProducts()->fetchProductImageId( $product['product_id'] );
			}
			$shop->getProducts()->updateProduct( $product );
		}
		if($product['product_id'] === false){
			unset($product['product_id']);
			$shop->getProducts()->saveProduct($product);
		}
		Renderer::redirect('/admin/products.admin.php');
	}
}

Renderer::render('./views/edit-product.view.php',[
	'title' => $title,
	'product' => $product,
	'navigation' => ADMIN_NAV,
	'categories' => $categories,
	'errors' => $errors
], '/public/admin/views/layout/admin.main.php');