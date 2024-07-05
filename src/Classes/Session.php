<?php

namespace Cm\Shop\Classes;

class Session {
	public string $id;
	public string $username;
	public array $cart;
	public string $role;
	public array $profile_img;

	public function __construct() {
		session_start();
		$this->id = $_SESSION['id'] ?? 0;
		$this->role = $_SESSION['role'] ?? 'guest';
		$this->username = $_SESSION['username'] ?? 'Guest User';
		$this->profile_img['image'] = $_SESSION['image'] ?? '';
		$this->profile_img['alt'] = $_SESSION['image_alt'] ?? '';
		$this->cart = $_SESSION['cart'] ?? [];
	}
	public function updateSessionCart(array $cart_items): void {
		$_SESSION['cart'] = $cart_items;
	}
	public function updateSession(array $user): void {
		$this->createSession($user);
	}
	public function createSession(array $user): void {
		session_regenerate_id(true);
		$_SESSION['id'] = $user['id'];
		$_SESSION['username'] = strstr($user['email'], '@', true);
		$_SESSION['expire'] = time() + 30 * 60;
		$_SESSION['role'] = $user['role'];
		$_SESSION['image'] = $user['image_name'];
		$_SESSION['image_alt'] = $user['image_alt'];
		$_SESSION['cart'] = [];
	}

	public function destroySession(): void {
		$_SESSION = [];
		$cookie_data = session_get_cookie_params();
		setcookie(session_name(), '', time() - 42000, $cookie_data['path'], $cookie_data['domain'], $cookie_data['secure'], $cookie_data['httponly']);
		session_destroy();
	}
}