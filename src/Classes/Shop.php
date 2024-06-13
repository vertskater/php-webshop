<?php

namespace Cm\Shop\Classes;

class Shop {
	protected Database $db;
	protected Product $products;
	protected Category $category;

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
}

