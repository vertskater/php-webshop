<?php

namespace Cm\Shop\Classes;

class Product {
	protected Database $db;
	public function __construct(Database $db) {
		$this->db = $db;
	}

	public function fetchById(string $id): array {
		$sql = "SELECT p.name, p.description, p.price, p.rating, p.added_at, p.details, 
       			c.name as category_name, i.filename as image, i.alt as image_alt FROM products as p
            JOIN categories as c on p.category_id = c.id    
        		LEFT JOIN images as i on p.image_id = i.id
            where p.id = :id";
		return $this->db->sql_execute($sql, [':id' => $id])->fetch();
	}
	public function fetchAll(int $limit = 10): array {
		$sql = "SELECT p.id, p.name, p.description, p.price, p.added_at, c.id as cat_id, c.name as category_name, i.filename as image, i.alt as image_alt FROM products as p
            JOIN categories as c on p.category_id = c.id    
        		LEFT JOIN images as i on p.image_id = i.id
            ORDER BY p.added_at DESC                                                                                      
        		LIMIT :limit";
		return $this->db->sql_execute($sql, ['limit' => $limit])->fetchAll();
	}
	public function fetchProductsByCategory(string $cat_id): array {
		$sql = "SELECT p.id, p.name, p.description, p.price, p.added_at, c.id as cat_id, c.name as category_name, i.filename as image, i.alt as image_alt FROM products as p
            JOIN categories as c on p.category_id = c.id    
        		LEFT JOIN images as i on p.image_id = i.id
            WHERE p.category_id = :id
            ORDER BY p.added_at DESC";
		return $this->db->sql_execute($sql, ['id' => $cat_id])->fetchAll();
	}
}
