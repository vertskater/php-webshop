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
}