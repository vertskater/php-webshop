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
		$sql = "INSERT INTO users (firstname, lastname, email, password, role_id, profile_pic_id, birthdate, gender) 
    				VALUE (:firstname, :lastname, :email, :password, :role_id, :profile_pic_id, :birthdate, :gender)";

		try {
			$this->db->sql_execute($sql, $user);
			return true;
		} catch (\PDOException $e) {
			return false;
		}
	}
	public function fetchUserById(string|int $id): array|false {
		$sql = "SELECT u.id, u.firstname, u.lastname, CONCAT(u.firstname, ' ', u.lastname) as username, u.email, 
       			u.birthdate, u.gender, r.name as role,
       			i.filename as image_name, i.alt as image_alt
						FROM users as u
						JOIN roles as r on u.role_id = r.id
						LEFT JOIN images as i on u.profile_pic_id = i.id
						WHERE u.id = :id";
		return $this->db->sql_execute($sql, ['id' => $id])->fetch();
	}
	public function fetchUserByRole(string|int $role_id): array|false {
		$sql = "SELECT u.id, CONCAT(u.firstname, ' ', u.lastname) as name, u.email, u.birthdate, u.gender, 
       			r.name as role, i.filename, i.alt
						FROM users as u
						JOIN roles as r ON u.role_id = r.id
						LEFT JOIN images as i ON u.profile_pic_id = i.id
					  WHERE u.role_id = :role_id";
		return $this->db->sql_execute($sql, ['role_id' => $role_id])->fetchAll();
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
		$sql = "SELECT u.id, u.firstname, u.lastname, u.email, u.password, 
       			r.name as role, i.filename as image_name, i.alt as image_alt
						FROM users as u
						JOIN roles as r on u.role_id = r.id
						LEFT JOIN images as i on profile_pic_id = i.id
						WHERE email = :mail";
		return $this->db->sql_execute($sql, ['mail' => $email])->fetch();
	}
	public function updateUserProfileImgId(string $user_id, string|int $img_id): bool {
		$sql = "UPDATE users SET profile_pic_id = :img_id WHERE id = :user_id";
		try {
			$this->db->sql_execute($sql, [
				'img_id' => $img_id,
				'user_id' => $user_id
			]);
			return true;
		}catch (\PDOException $e) {
			return false;
		}
	}
	public function fetchAllUsers(int $limit = 10): array {
		$sql = "SELECT u.id, CONCAT(u.firstname, ' ', u.lastname) as name, u.email, u.birthdate, u.gender, 
       			r.name as role, i.filename, i.alt
						FROM users as u
						JOIN roles as r ON u.role_id = r.id
						LEFT JOIN images as i ON u.profile_pic_id = i.id
						LIMIT :limit";
		return $this->db->sql_execute($sql, ['limit' => $limit])->fetchAll();
	}
	public function changeRole(int|string $user_id, int|string $new_role): void {
		$sql = "UPDATE users SET role_id = :new_role WHERE id = :user_id";
		$this->db->sql_execute($sql, ['new_role' => $new_role, 'user_id' => $user_id]);
	}
	public function deleteUser(string|int $user_id): false|\PDOStatement {
		$sql = "DELETE FROM users WHERE id = :user_id";
		return $this->db->sql_execute($sql, ['user_id' => $user_id]);
	}
}
