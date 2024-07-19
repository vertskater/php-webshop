<?php

namespace Cm\Shop\Classes;

class SoldProducts {

	private Database $db;
	public function __construct(Database $db) {
		$this->db = $db;
	}
	public function saveProduct(array $product): bool {
		$sql = "INSERT INTO sold_products SET product_id = :product_id, user_id = :user_id, quantity = :quantity";
		return (bool)$this->db->sql_execute($sql, $product);
	}
	public function fetchSoldProducts(int|string $user_id, int $limit = 3): array {
		$sql = "SELECT s.product_id, s.user_id, s.date_sold, p.id, p.name, p.price, p.in_store, p.description,
       			p.added_at, c.id as cat_id, c.name as category_name, 
       			i.filename as image, i.alt as image_alt FROM sold_products as s
						JOIN products as p ON p.id = s.product_id
       			JOIN categories as c on p.category_id = c.id    
        		LEFT JOIN images as i on p.image_id = i.id
						WHERE s.user_id = :user_id ORDER BY date_sold DESC LIMIT :limit";
		return $this->db->sql_execute($sql, ['user_id' => $user_id, 'limit' => $limit])->fetchAll();
	}
}