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
				'user_id' => $_SESSION['id']
			]);
			return true;
		}catch(\PDOException $e) {
			return false;
		}
	}

	public function changeUserId($userid): void {
		$sql = "UPDATE cart_items SET user_id = :userid";
		$this->db->sql_execute($sql, ['userid' => $userid]);
	}
	public function fetchCartItems(int $user_id): array {
		$sql = "SELECT c.id, c.product_id, c.quantity, c.user_id, p.name, p.price, CONCAT(u.firstname, ' ', u.lastname) as username  FROM cart_items as c
						JOIN products as p on c.product_id = p.id
						JOIN users as u on c.user_id = u.id
						WHERE c.user_id = :id";
		return $this->db->sql_execute($sql, ['id' => $user_id])->fetchAll();
	}

	public function cartItemsCount(int|string $user_id = Config::GUEST_USER_ID): int|false|null {
	$sql = "Select SUM(quantity) as quantity FROM cart_items WHERE user_id = :id";
		try {
			return $this->db->sql_execute($sql, ['id' => $user_id])->fetch()['quantity'];
		}catch (\PDOException $e) {
			return false;
		}
	}

	/**
	 * Deletes cart item by table cart_item id
	 * @param string $cart_id
	 *
	 * @return bool
	 */
	public function deleteItem(string $product_id): bool {
		$sql = "DELETE FROM cart_items WHERE product_id = :id";
		try {
			$this->db->sql_execute($sql, ['id' => $product_id]);
			return true;
		} catch(\PDOException $e) {
			return false;
		}
	}
	public function isItemInCart(string $prod_id, int $user_id):bool {
		$sql = "SELECT id FROM cart_items WHERE product_id = :prod_id and user_id = :user_id";
		$is_in_cart = $this->db->sql_execute($sql, ['prod_id' => $prod_id, 'user_id' => $user_id])->fetch();
		return (bool)$is_in_cart;
	}

	public function addAmount(array $cart_item): bool {
		['product_id' => $product_id, 'quantity' => $quantity,'user_id' => $user_id] = $cart_item;
		$sql = "SELECT quantity FROM cart_items WHERE product_id = :prod_id and user_id = :user_id";
		$current_amount = $this->db->sql_execute($sql, ['prod_id' => $product_id, 'user_id' => $user_id])->fetchColumn();

		if($current_amount >= Config::MAX_ORDER_AMOUNT) {
			return false;
		};

		$sql = "UPDATE cart_items SET quantity = quantity + :amount  WHERE product_id = :prod_id and user_id = :user_id";
		$this->db->sql_execute($sql, ['amount' => $quantity, 'prod_id' => $product_id, 'user_id' => $user_id]);
		return true;
	}

	public function setNewAmount(int $amount, string $prod_id): void {
		if($amount > Config::MAX_ORDER_AMOUNT) return;
		$sql = "UPDATE cart_items SET quantity = :amount  WHERE product_id = :prod_id";
		$this->db->sql_execute($sql, ['amount' => $amount, 'prod_id' => $prod_id]);
	}
}