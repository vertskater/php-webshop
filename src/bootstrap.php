<?php

require dirname(__DIR__) .  '/vendor/autoload.php';
use Cm\Shop\Config\Config;
use Cm\Shop\Classes\Shop;

(new Config());
$shop = new Shop(Config::getDsn(), Config::DB_USERNAME, Config::DB_PASSWORD);
$session = $shop->getSession();
$count = $shop->getShoppingCart()->cartItemsCount();

