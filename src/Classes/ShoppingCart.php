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
	public function fetchCartItems(): array {
		$sql = "SELECT c.product_id, c.quantity, c.user_id, p.name, p.price, CONCAT(u.firstname, ' ', u.lastname) as username  FROM cart_items as c
						JOIN products as p on c.product_id = p.id
						JOIN users as u on c.user_id = u.id";
		return $this->db->sql_execute($sql)->fetchAll();
	}

	public function cartItemsCount(): int|false|null {
		$sql = "Select SUM(quantity) as quantity FROM cart_items";
		try {
			return $this->db->sql_execute($sql)->fetch()['quantity'];
		}catch (\PDOException $e) {
			return false;
		}
	}

}