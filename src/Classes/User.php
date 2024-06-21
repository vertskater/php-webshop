<?php

namespace Cm\Shop\Classes;

class User {
	private Database $db;

	public function __construct(Database $db) {
		$this->db = $db;
	}

	public function login(string $email, string $password): false|array {
		$user = self::fetchUserByMail($email);

		if(!$user) {
			return false;
		}

		if(password_verify($password, $user['password'])) {
			return $user;
		}
		return false;
	}

	public function registerUser(array $user): bool {
		$user['password'] = password_hash($user['password'], PASSWORD_ARGON2I);
		$sql = "INSERT INTO users (firstname, lastname, email, password, role_id) VALUE (:firstname, :lastname, :email, :password, role_id)";

		try {
			$this->db->sql_execute($sql, $user);
			return true;
		} catch (\PDOException $e) {
			return false;
		}
	}

	public function fetchUserByMail(string $email): array|false {
		$sql = "SELECT u.id, u.firstname, u.lastname, u.email, u.password, r.name as role
						FROM users as u
						JOIN roles as r on u.role_id = r.id
						WHERE email = :mail";
		return $this->db->sql_execute($sql, ['mail' => $email])->fetch();
	}

}