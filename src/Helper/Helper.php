<?php

namespace Cm\Shop\Helper;

use Cm\Shop\Classes\Shop;

class Helper {
	private object $shop;
	public function __construct(Shop $shop) {
		$this->shop = $shop;
	}
	public function sumCartItemsQuantity(): int {
		return array_reduce($this->shop->getSession()->cart, function($carry, $item) {
			return $carry + $item['quantity'];
		});
	}

	public static function combineCart(array $db_cart, array $session_cart): array {
			if(empty($db_cart)) return $session_cart;
			if(empty($session_cart)) return $db_cart;
			$db_cart = array_values($db_cart);
			$session_cart = array_values($session_cart);
			$combined = [];
			foreach($db_cart as $db_key => $db_item) {
				foreach($session_cart as $session_key => $session_item) {
					if((int)$db_item['product_id'] == (int)$session_item['product_id']){
						$db_item['quantity']++;
						$combined[] = $db_item;
						unset($session_cart[$session_key]);
						unset($db_cart[$db_key]);
					}
				}
			}
		return array_merge($combined, $session_cart, $db_cart);
	}
}