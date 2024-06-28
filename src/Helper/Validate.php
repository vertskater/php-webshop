<?php

namespace Cm\Shop\Helper;

class Validate {
	public static function validatePassword(string $password): bool {
		$valid['upper_letter'] = preg_match('/[A-Z]/', $password);
		$valid['lower_letter'] = preg_match('/[a-z]/', $password);
		$valid['number'] = preg_match('/[0-9]/', $password);
		$valid['special_char'] = preg_match('/\W/', $password);

		if(mb_strlen($password) >= 8 && $valid['upper_letter'] && $valid['lower_letter'] && $valid['number'] && $valid['special_char']) {
			return true;
		}
		return false;
	}
	public static function validate_is_string(string $text, int $min = 1, int $max = 10000): bool {
		return mb_strlen($text) >= $min and mb_strlen($text) <= $max;
 	}
	 public static function validate_is_int(int $num, int $min = 0, int $max = PHP_INT_MAX): bool {
		return $num >= $min and $num <= $max;
	 }

}