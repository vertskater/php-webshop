<?php

namespace Cm\Shop\Classes;

class Category {
	private Database $db;
	public function __construct(Database $db) {
		$this->db = $db;
	}

	public function getNavigation(): array {
		$sql = "SELECT id, name FROM categories WHERE navigation = 1";
		return $this->db->sql_execute($sql)->fetchAll();
	}
	public function getCategoryById(string $id):array {
		$sql = "SELECT id, name, description, navigation FROM categories WHERE id = :id";
		return $this->db->sql_execute($sql, ['id' => $id])->fetch();
	}
	public function getAll(int $limit = 10): array {
		$sql = "SELECT * FROM categories LIMIT :limit";
		return $this->db->sql_execute($sql, ['limit' => $limit])->fetchAll();
	}
	public function updateCategory(array $category): void {
		$sql = "UPDATE categories SET name = :name, description = :description, navigation = :nav
						WHERE id = :cat_id";
		$this->db->sql_execute($sql, $category);
	}
	public function setNewCategory(array $category):void {
		$sql = "INSERT INTO categories (name, description, navigation) VALUES (:name, :description, :nav)";
		$this->db->sql_execute($sql, $category);
	}
	public function deleteCategory(int|string $cat_id):void {
		$sql = "DELETE FROM categories WHERE id = :cat_id";
		$this->db->sql_execute($sql, ['cat_id' => $cat_id]);
	}
}