<?php

namespace Cm\Shop\Helper;

use Cm\Shop\Classes\Shop;

class Helper {
	private object $shop;
	public function __construct(Shop $shop) {
		$this->shop = $shop;
	}

	public function sumCartItemsQuantity(): int {
		return array_reduce($this->shop->getSession()->cart, function($carry, $item) {
			return $carry + $item['quantity'];
		});
	}

	public static function combineCart(array $db_cart, array $session_cart): array {
			if(empty($db_cart)) return $session_cart;
			if(empty($session_cart)) return $db_cart;
			$db_cart = array_values($db_cart);
			$session_cart = array_values($session_cart);
			$combined = [];
			foreach($db_cart as $db_key => $db_item) {
				foreach($session_cart as $session_key => $session_item) {
					if((int)$db_item['product_id'] == (int)$session_item['product_id']){
						$db_item['quantity']++;
						$combined[] = $db_item;
						unset($session_cart[$session_key]);
						unset($db_cart[$db_key]);
					}
				}
			}
		return array_merge($combined, $session_cart, $db_cart);
	}

	public static function get_file_path( string $filename, string $path ): string {
		$basename  = pathinfo( $filename, PATHINFO_FILENAME );
		$extension = pathinfo( $filename, PATHINFO_EXTENSION );
		$basename  = preg_replace( '/[^A-z0-9]/', '-', $basename );
		$i         = 0;
		while ( file_exists( $path . $filename ) ) {
			$i ++;
			$filename = $basename . $i . '.' . $extension;
		}

		return $path . $filename;
	}

	public static function scale_and_copy( string $filename, string $save_to, $max_width = 1024, $max_height = 1024 ): bool {
		// Get new sizes
		[ $orig_width, $orig_height, $mime_type ] = getimagesize( $filename );
		if ( $orig_width === null || $orig_height === null ) {
			return false;
		}

		$source = match ( $mime_type ) {
			IMAGETYPE_JPEG => imagecreatefromjpeg( $filename ),
			IMAGETYPE_PNG => imagecreatefrompng( $filename ),
			default => false,
		};

		$size = min(imagesx($source), imagesy($source));
		$thumb = imagecreatetruecolor( $size, $size );
		// Resize
		imagecopyresampled( $thumb, $source, 0, 0, 0, 0, $size, $size, $max_width, $max_height );
		// Output
		match ( $mime_type ) {
			IMAGETYPE_JPEG => imagejpeg( $thumb, $save_to ),
			IMAGETYPE_PNG => imagepng( $thumb, $save_to ),
			default => false,
		};
		imagejpeg( $thumb, $save_to );
		imagedestroy( $thumb );
		imagedestroy( $source );

		return true;
	}
}