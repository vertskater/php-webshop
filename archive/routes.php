<?php

use archive\Router;

$router = new Router();
$router->get('/category.php', 'CategoryController@show');
$router->get('/add-to-cart.php', 'AddToCartController@add');
$router->dispatch($shop);

