<?php

namespace Cm\Shop\Classes;

use Cm\Shop\Config\Config;

class User {
	private Database $db;

	public function __construct(Database $db) {
		$this->db = $db;
	}

	public function login(string $email, string $password): false|array {
		$user = self::fetchLoginCredentials($email);

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
		$sql = "INSERT INTO users (firstname, lastname, email, password, role_id, profile_pic_id) VALUE (:firstname, :lastname, :email, :password, :role_id, :profile_pic_id)";

		try {
			$this->db->sql_execute($sql, $user);
			return true;
		} catch (\PDOException $e) {
			return false;
		}
	}
	public function fetchUserById(string|int $id): array|false {
		$sql = "SELECT u.id, CONCAT(u.firstname, ' ', u.lastname) as username, u.email, r.name as role,
       			i.filename as image_name, i.alt as image_alt
						FROM users as u
						JOIN roles as r on u.role_id = r.id
						LEFT JOIN images as i on u.profile_pic_id = i.id
						WHERE u.id = :id";
		return $this->db->sql_execute($sql, ['id' => $id])->fetch();
	}


	public function getUserRole(string|int $id = Config::GUEST_USER_ID): array|false {
		$sql = "SELECT CONCAT(u.firstname, ' ', u.lastname), r.name as role
						FROM users as u
						JOIN roles as r on u.role_id = r.id
						WHERE u.id = :id";
		return $this->db->sql_execute($sql, ['id' => $id])->fetch();
	}

	public function emailExists(string $email): bool {
		$sql = "SELECT email FROM users WHERE email = :email";
		return (bool)$this->db->sql_execute($sql, ['email' => $email])->fetch();
	}

	private function fetchLoginCredentials(string $email): array|false {
		$sql = "SELECT u.id, u.firstname, u.lastname, u.email, u.password, r.name as role
						FROM users as u
						JOIN roles as r on u.role_id = r.id
						WHERE email = :mail";
		return $this->db->sql_execute($sql, ['mail' => $email])->fetch();
	}
}
