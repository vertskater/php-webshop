<?php
namespace Cm\Shop\Config;

class Config {
	//DATABASE
	const string DB_TYPE = 'mysql';
	const string DB_HOST = 'localhost';
	const int DB_PORT = 8889;
	const string DB_NAME = 'cm_shop';
	const string DB_USERNAME = 'cm_shop';
	const string DB_PASSWORD = '';
	//ORDER DATA
	const float UST = 0.2;
	const int MAX_ORDER_AMOUNT = 5;
	//USER DATA
	const int GUEST_USER_ID = 3;
	const string DEFAULT_USER_ROLE = 'customer';
	//UPLOAD
	const array IMAGE_TYPES = ['header_img', 'profile_img', 'product_img'];

	public function __construct() {
		define('ROOT_PATH', dirname(__DIR__, 2));
	}

	public static function getDsn(): string {
		return self::DB_TYPE . ':host=' . self::DB_HOST . ':' . self::DB_PORT .';dbname=' . self::DB_NAME;
	}
}

