<?php

require dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\ShopHandler;

$cat_id = filter_input(INPUT_GET, 'cat_id', FILTER_VALIDATE_INT) ? $_GET['cat_id'] : '';
(new ShopHandler($shop))->handleAddToCartRequest();


if($cat_id !== '') {
	header('LOCATION: /category.php?cat_id=' . $cat_id);
}else {
	header('LOCATION: /index.php');
}
exit;

