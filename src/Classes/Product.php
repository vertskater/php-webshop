<?php

namespace Cm\Shop\Classes;

class Product {
	protected Database $db;
	public function __construct(Database $db) {
		$this->db = $db;
	}

	public function fetchById(string $id): array {
		$sql = "SELECT p.id, p.name, p.description, p.price, p.rating, p.added_at, p.details, p.in_store, p.category_id,
       			c.name as category_name, i.filename as image, i.alt as image_alt FROM products as p
            JOIN categories as c on p.category_id = c.id    
        		LEFT JOIN images as i on p.image_id = i.id
            where p.id = :id";
		return $this->db->sql_execute($sql, [':id' => $id])->fetch();
	}
	public function fetchAll(int $limit = 10): array {
		$sql = "SELECT p.id, p.name, p.in_store, p.description, p.price, p.added_at,
       			c.id as cat_id, c.name as category_name, 
       			i.filename as image, i.alt as image_alt FROM products as p
            JOIN categories as c on p.category_id = c.id    
        		LEFT JOIN images as i on p.image_id = i.id
            ORDER BY p.added_at DESC                                                                                      
        		LIMIT :limit";
		return $this->db->sql_execute($sql, ['limit' => $limit])->fetchAll();
	}
	public function fetchStoredProducts(int $min_store = 0): array {
		$sql = "SELECT p.name, p.in_store FROM products as p WHERE in_store > :min_store";
		return $this->db->sql_execute($sql, ['min_store' => $min_store])->fetchAll();
	}
	public function fetchProductsByCategory(string $cat_id): array {
		$sql = "SELECT p.id, p.name, p.in_store, p.description, p.price, p.added_at, c.id as cat_id, c.name as category_name, i.filename as image, i.alt as image_alt FROM products as p
            JOIN categories as c on p.category_id = c.id    
        		LEFT JOIN images as i on p.image_id = i.id
            WHERE p.category_id = :id
            ORDER BY p.added_at DESC";
		return $this->db->sql_execute($sql, ['id' => $cat_id])->fetchAll();
	}
	public function fetchProductImageId(string|int $product_id): int {
		$sql = "SELECT image_id from products WHERE id = :product_id";
		return $this->db->sql_execute($sql, ['product_id' => $product_id])->fetchColumn();
	}
	public function updateProduct(array $product): void {
		$sql = "UPDATE products SET name = :name, description = :description, details = :details, price = :price,
						in_store = :in_store, category_id = :category_id, user_id = :user_id, image_id = :image_id WHERE id = :product_id";
		$this->db->sql_execute($sql, $product);
	}
	public function saveProduct(array $product): void {
		$sql = "INSERT INTO products (name, description, details, price, in_store, category_id, user_id, image_id) 
						VALUES (:name, :description, :details, :price, :in_store, :category_id, :user_id, :image_id)";
		$this->db->sql_execute($sql, $product);
	}
	public function getImageId(int|string $product_id): int|string {
		$sql = "SELECT image_id FROM products WHERE id = :product_id";
		return $this->db->sql_execute($sql, ['product_id' => $product_id])->fetchColumn();
	}
	public function deleteProduct(int|string $product_id): bool {
		$sql = "DELETE FROM products WHERE id = :product_id";
		return (bool)$this->db->sql_execute($sql, ['product_id' => $product_id]);
	}
}
