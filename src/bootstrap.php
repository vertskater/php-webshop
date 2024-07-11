<?php

require dirname(__DIR__) .  '/vendor/autoload.php';
use Cm\Shop\Config\Config;
use Cm\Shop\Classes\Shop;
use Cm\Shop\Helper\Helper;

(new Config());
const ADMIN_NAV = [
	'Dashboard' => '../admin/admin.php',
	'Products' => '../admin/products.admin.php',
	'Categories' => '../admin/categories.admin.php',
	'Users' => '../admin/users.admin.php'
];
$shop = new Shop(Config::getDsn(), Config::DB_USERNAME, Config::DB_PASSWORD);
$session = $shop->getSession();

$count = $shop->getShoppingCart()->cartItemsCount($_SESSION['id'] ?? $shop->getSession()->id);

if(!empty($shop->getSession()->cart)) {
	$count = (new Helper($shop))->sumCartItemsQuantity();
}
