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
	const int GUEST_USER_ID = 3; //TODO: Replace id with name
	const string DEFAULT_USER_ROLE = 'customer';
	const array GENDER = ['male', 'female', 'binary'];
	//UPLOAD
	//TODO:Replace with DB call
	const array IMAGE_TYPES = ['header_img', 'profile_img', 'product_img'];
	const array MEDIA_TYPES = ['image/jpg', 'image/jpeg', 'image/png'];
	const string PROFILE_IMAGE_PLACEHOLDER_MALE = 'profile_male.png';
	const string PROFILE_IMAGE_PLACEHOLDER_FEMALE = 'profile_female.png';
	const string PROFILE_IMAGE_PLACEHOLDER = 'profile_placeholder.png';
	const string PROFILE_IMG_ALT_TEXT = 'profile image';


	public function __construct() {
		define('ROOT_PATH', dirname(__DIR__, 2));
		define('UPLOAD_DIR', dirname(__DIR__, 2) . '/public/img/');
	}

	public static function getDsn(): string {
		return self::DB_TYPE . ':host=' . self::DB_HOST . ':' . self::DB_PORT .';dbname=' . self::DB_NAME;
	}
}

