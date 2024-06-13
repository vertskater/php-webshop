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
		$sql = "SELECT id, name FROM categories WHERE id = :id";
		return $this->db->sql_execute($sql, ['id' => $id])->fetch();
	}
}