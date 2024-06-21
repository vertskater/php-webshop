<?php

namespace Cm\Shop\Classes;

class Shop {
	protected Database $db;
	protected Product $products;
	protected Category $category;
	protected Image $img;
	protected ShoppingCart $shopping_cart;
	protected Session $session;
  protected User $user;

	public function __construct(string $dsn, string $username, string $password) {
		$this->db = new Database($dsn, $username, $password);
	}
	public function getProducts(): Product {
		if(empty($this->product)) {
			$this->products = new Product($this->db);
		}
		return $this->products;
	}
	public function getCategories(): Category {
		if(empty($this->category)) {
			$this->category = new Category($this->db);
		}
		return $this->category;
	}
	public function getImages(): Image {
		if(empty($this->img)) {
			$this->img = new Image($this->db);
		}
		return $this->img;
	}
	public function getShoppingCart(): ShoppingCart {
		if(empty($this->shopping_cart)) {
			$this->shopping_cart = new ShoppingCart($this->db);
		}
		return $this->shopping_cart;
	}
	public function getSession(): Session {
		if(empty($this->session)) {
			$this->session = new Session();
		}
		return $this->session;
	}
	public function getUsers(): User {
		if(empty($this->user)) {
			return new User($this->db);
		}
		return $this->user;
	}

}

