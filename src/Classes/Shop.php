<?php

namespace Cm\Shop\Classes;

class Shop {
	protected Database $db;
	protected Product $products;
	protected Category $category;
	protected Image $img;

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

}

