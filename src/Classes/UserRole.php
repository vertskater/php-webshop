<?php

namespace Cm\Shop\Classes;

class UserRole {
	protected Database $db;
	public function __construct(Database $db) {
		$this->db = $db;
	}

	public function getRoleId(string $role): int|false {
		$sql = "SELECT id FROM roles WHERE name = :role";
		return $this->db->sql_execute($sql, ['role' => $role])->fetchColumn();
	}
	public function fetchAllRoles(int $limit = 10): array{
		$sql = "SELECT id, name FROM roles LIMIT :limit";
		return $this->db->sql_execute($sql, ['limit' => $limit])->fetchAll();
	}

}