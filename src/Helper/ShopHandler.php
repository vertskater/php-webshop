<?php

namespace Cm\Shop\Helper;
use Cm\Shop\Classes\Shop;

class ShopHandler {
	private Shop $shop;
	private ?array $errors = null;
	public function __construct(Shop $shop) {
		$this->shop = $shop;
	}

	public function handleAddToCartRequest(): self {

			$product_id = filter_input(INPUT_GET, 'id') ?? '';
			$quantity = filter_input(INPUT_POST, 'quantity') ?? 1;
			$product = $this->shop->getProducts()->fetchById($product_id);
			$this->errors['product'] = !empty($product) ? '' : 'Could not fetch product';
			$this->errors['quantity'] = $quantity > 0 ? '' : 'Quantity must be greater than 0';
			$no_errors = implode($this->errors);
			$saved = false;
			if(!$no_errors) {
				$saved = $this->shop->getShoppingCart()->addToCart($product, $quantity);
			}
			$this->errors['saved'] = $saved ? 'Successfully moved to Shopping Cart' : 'Could not connect to Database.';
		return $this;
	}
	public function getErrors(): ?array {
		return $this->errors;
	}
}