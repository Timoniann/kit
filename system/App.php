<?php

	class App
	{
		private static $router;
		public static $db;

		public static function getRouter()
		{
			return self::$router;
		}

		public static function run($uri)
		{
			self::$router = new Router($uri);
			self::$db = Config::getDatabase();

			$controller_class = ucfirst(self::$router->getController()) . 'Controller';
			$controller_method = strtolower(self::$router->getMethodPrefix() . self::$router->getAction());
			$layout = self::$router->getRoute();


			// Redirecting type here
			// It makes for routing admin, etc

			$content = "";

			$controller_object = new $controller_class();
			if (method_exists($controller_object, "init")) {
				$controller_object->init();
			}

			if (method_exists($controller_object, $controller_method)) {
				$view_path = $controller_object->$controller_method();
				$view_object = new View($controller_object->getData(), $view_path);
				$content = $view_object->render();
			} else{
				$view_path = VIEWS . "/404.html";
				$view_object = new View($controller_object->getData(), $view_path);
				$content = $view_object->render();
				//echo "NOT FOUND METHOD $controller_method";
				// Handle not found method
			}

			$layout_path = VIEWS . "/$layout.html";
			$layout_view_object = new View(compact("content"), $layout_path);
			echo $layout_view_object->render();
		}

		public static function adminPermission()
		{
			$user = Session::getCurrentUser();
			if (!$user || $user['access'] < 2)
				return false;
			return true;
		}

		public static function teacherPermission()
		{
			$user = Session::getCurrentUser();
			if (!$user || $user['access'] < 1)
				return false;
			return true;
		}

		// Joke)
		public static function superAdminPermission()
		{
			$user = Session::getCurrentUser();
			if (!$user || $user['first_name'] != "Timoniann")
				return false;
			return true;
		}

	}
?>