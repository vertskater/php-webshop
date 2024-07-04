<?php

require dirname(__DIR__) . '/src/bootstrap.php';
use Cm\Shop\Helper\Renderer;
use Cm\Shop\Config\Config;

$session->destroySession();
//$shop->getShoppingCart()->changeUserId(Config::GUEST_USER_ID);

Renderer::redirect('/index.php');

