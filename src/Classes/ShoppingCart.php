<?php

namespace Cm\Shop\Classes;

use Cm\Shop\Config\Config;

class ShoppingCart {
	protected Database $db;
	public function __construct(Database $db) {
		$this->db = $db;
	}

	public function addToCart(array $product, int $quantity): bool {
		$sql = "INSERT INTO cart_items (product_id, quantity, user_id) VALUES(:product_id, :quantity, :user_id)";
		try {
			$this->db->sql_execute($sql, [
				'product_id' =>  $product['id'],
				'quantity' => $quantity,
				'user_id' => $product['user_id'] ?? Config::GUEST_USER_ID
			]);
			return true;
		}catch(\PDOException $e) {
			return false;
		}
	}
}