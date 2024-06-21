<?php

namespace archive;

class Router {
	private array $routes = [];
	private const string CONTROLLER_NAMESPACE = "\Cm\Shop\Controllers\\";

	public function get($uri, $action): void {
		$this->routes['GET'][$uri] = $action;
	}
	public function post($uri, $action): void {
		$this->routes['POST'][$uri] = $action;
	}
	public function dispatch($shop): void {
		$uri = $this->getCurrentUri();
		$method = $_SERVER['REQUEST_METHOD'];
		if(isset($this->routes[$method][$uri])) {
			$action = $this->routes[$method][$uri];
			if(is_callable($action)) {
				call_user_func($action);
			}else {
				$this->callControllerAction($action, $shop);
			}
		}
	}


	private function getCurrentUri(): string {
		$uri = $_SERVER['REQUEST_URI'];
		$uri = parse_url($uri, PHP_URL_PATH);
		return rtrim($uri, '/');
	}

	private function  callControllerAction($action, $shop): void {
		[$controller, $method] = explode('@', $action);
		$class_def = self::CONTROLLER_NAMESPACE . $controller;
		$controller = new $class_def();
		$controller->$method($shop);
	}
}