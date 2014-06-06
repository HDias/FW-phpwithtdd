<?php

namespace SON\Init;

abstract class Bootstrap {
	protected $routes;
	
	public function __construct() {
		$this->initRoutes();
		$this->run($this->getUrl());
	}
	public function setRoutes(array $routes) {
		$this->routes = $routes;
	}
	protected function run($url) {
		array_walk ( $this->routes, function ($route) use($url) {
			if ($url == $route ['route']) {
				$class = "HAD\\Controllers\\" . ucfirst ( $route ['controller'] );
				$controller = new $class();
				$controller->$route ['action'] ();
			}
		} );
	}
	protected function getUrl() {
		/*
		 * Pegar URL sem ?a=1&b=2 Primeira Forma
		 */
		return parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
		
		/*
		 * Segunda Forma
		 */
		// $pattern = "#([a-zA-Z0-9\/]+)(\?.*)?#";
		// $x = preg_replace($pattern, "$1", $_SERVER['REQUEST_URI']);
		// return $x;
	}
	
	abstract protected function initRoutes();
}
