<?php

require dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\ShopHandler;
use Cm\Shop\Helper\Renderer;

$cat_id = filter_input(INPUT_GET, 'cat_id', FILTER_VALIDATE_INT) ? $_GET['cat_id'] : '';
(new ShopHandler($shop))->handleAddToCartRequest();

if($cat_id !== '') {
	Renderer::redirect('/category.php', ['cat_id' => $cat_id]);
}else {
	Renderer::redirect('/index.php');
}


