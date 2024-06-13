<?php

namespace Cm\Shop\Classes;
use \PDO;
class Database extends PDO {
	public function __construct(string $dsn, string $user, string $password, array $options = []) {
			$default = [
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
		];
		parent::__construct($dsn, $user, $password, array_replace($default, $options));
	}

	public function sql_execute(string $sql, array $bindings = []): \PDOStatement {
		if(empty($bindings)) {
			return $this->query($sql);
		}
		$stmt = $this->prepare($sql);
		foreach ($bindings as $key => $value) {
			if(is_int($value)) {
				$stmt->bindValue($key, $value, self::PARAM_INT);
			}else {
				$stmt->bindValue($key, $value);
			}
		}
		$stmt->execute();
		return $stmt;
	}
}


