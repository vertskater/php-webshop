<?php

namespace Cm\Shop\Helper;

use JetBrains\PhpStorm\NoReturn;

class Renderer {
	public static function render(string $path, array $args = [], string $template_path = '/public/views/layout/index.main.php'): void {
		ob_start();
		extract($args);
		require $path;
		$content = ob_get_contents();
		ob_clean();
		include dirname(__DIR__, 2) . $template_path;
	}

	public static function e(string $output): string {
		return htmlspecialchars($output, ENT_QUOTES, false);
	}
	#[NoReturn] public static function redirect(string $url, array $params = [], int $status_code = 302): void {
		$query = $params ? '?' . http_build_query($params) : '';
		header("LOCATION: $url$query", $status_code);
		exit;
	}

	public static function formatDate(string $date): string {
		$date = strtotime($date);
		return date('d. M. Y', $date);
	}
}








