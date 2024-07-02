<?php

namespace Cm\Shop\Helper;

class Renderer {
	public static function render(string $path, array $args = []): void {
		ob_start();
		extract($args);
		require $path;
		$content = ob_get_contents();
		ob_clean();
		include dirname(__DIR__, 2) . '/public/views/layout/index.main.php';
	}

	public static function e(string $output): string {
		return htmlspecialchars($output, ENT_QUOTES, false);
	}

	public static function redirect(string $url, array $params = [], int $status_code = 302): void {
		$query = $params ? '?' . http_build_query($params) : '';
		header("LOCATION: $url$query", $status_code);
		exit;
	}
}





