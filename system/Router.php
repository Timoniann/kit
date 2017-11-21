<?php

	class Router
	{
		private $uri, $route, $controller, $action, $params, $method_prefix;

		// Uri parser
		function __construct($uri)
		{
			$this->uri = urldecode(trim($uri, "/"));
			$this->route = Config::getDefaultRoute();
			$this->controller = Config::getDefaultController();
			$this->action = Config::getDefaultAction();
			$routes = Config::getRoutes();
			$uri_parts = explode("?", $uri);
			$path = $uri_parts[0];
			$path_parts = explode('/', $path);
			$current = 1;
			if (count($path_parts)) {
				if (in_array(strtolower($path_parts[$current]), array_keys($routes))) {
					$this->route = strtolower($path_parts[$current++]);
					$this->method_prefix = isset($routes[$this->route]) ? $routes[$this->route] : "";
				}
				print_r($path_parts);
				if (isset($path_parts[$current]) && $path_parts[$current]) {
					$this->controller = strtolower($path_parts[$current++]);
				}
				if(isset($path_parts[$current]) && $path_parts[$current]){
					$this->action = strtolower($path_parts[$current++]);
				}
				
				$this->params = $path_parts;
			}
		}

		public function getRoute()
		{
			return $this->route;
		}

		public function getController()
		{
			return $this->controller;
		}

		public function getAction()
		{
			return $this->action;
		}

		public function getParams()
		{
			return $this->params;
		}

		public function getMethodPrefix()
		{
			return $this->method_prefix;
		}

		public function getUri()
		{
			return $this->uri;
		}
	}

?>