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
}