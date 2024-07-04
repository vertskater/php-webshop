<?php

require dirname(__DIR__) .  '/vendor/autoload.php';
use Cm\Shop\Config\Config;
use Cm\Shop\Classes\Shop;
use Cm\Shop\Helper\Helper;

(new Config());
$shop = new Shop(Config::getDsn(), Config::DB_USERNAME, Config::DB_PASSWORD);
$session = $shop->getSession();
//TODO: if not logged in counting incorrect
$count = $shop->getShoppingCart()->cartItemsCount($_SESSION['id'] ?? $shop->getSession()->id);

if(!empty($shop->getSession()->cart)) {
	$count = (new Helper($shop))->sumCartItemsQuantity($shop->getSession()->cart);
}
