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
			$cart_item['product_id'] = filter_input(INPUT_GET, 'id') ?? '';
			$cart_item['quantity'] = filter_input(INPUT_POST, 'quantity') ?? 1;
			$product = $this->shop->getProducts()->fetchById($cart_item['product_id']);
			$this->errors['product'] = !empty($product) ? '' : 'Could not fetch product';
			$this->errors['quantity'] = $cart_item['quantity'] > 0 ? '' : 'Quantity must be greater than 0';
			$no_errors = implode($this->errors);
			$cart_item['user_id'] = $this->shop->getSession()->id ?? 0;
			$saved = false;
			if(!$no_errors) {
				if($cart_item['user_id']) {
					$is_in_cart = $this->shop->getShoppingCart()->isItemInCart( $cart_item['product_id'], $cart_item['user_id'] );
					if ( $is_in_cart ) {
						$this->shop->getShoppingCart()->addAmount($cart_item);
						return $this;
					}
					$saved = $this->shop->getShoppingCart()->addToCart( $product, $cart_item['quantity'] );
				}else {
					if(empty($_SESSION['cart'])) {
						$_SESSION['cart'][$cart_item['product_id']] = $cart_item;
						return $this;
					}
					if(array_key_exists($cart_item['product_id'], $_SESSION['cart'])) {
						$_SESSION['cart'][$cart_item['product_id']]['quantity'] += 1;
						return $this;
					}
					$_SESSION['cart'][$cart_item['product_id']] = $cart_item;
				}
			}
			$this->errors['saved'] = $saved ? 'Successfully moved to Shopping Cart' : 'Could not connect to Database.';
		return $this;
	}
	public function getErrors(): ?array {
		return $this->errors;
	}
}