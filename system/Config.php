<?php

	class Config
	{
		private static $app_params = array();

		private static $routes = array(
			"default" => "", 
			"admin" => "admin_");
		private static $db;


		public static function get($key)
		{
			return isset(self::$app_params[$key]) ? self::$app_params[$key] : "";
		}

		public static function getRoutes()
		{
			return self::$routes;
		}

		public static function getDefaultRoute()
		{
			return self::get("default_route");
		}

		public static function getDefaultController()
		{
			return self::get("default_controller");
		}

		public static function getDefaultAction()
		{
			return self::get("default_action");
		}

		public static function getDatabase()
		{
			return self::$db ? self::$db : self::$db = new Database(self::get('db.host'), self::get('db.login'), self::get('db.password'), self::get("db.name"));
		}

		public static function init()
		{
			$lines = file(dirname(__FILE__) ."/config.ini", FILE_IGNORE_NEW_LINES);

			foreach ($lines as $line) {
				$splited = explode('=', $line);
				if (count($splited)) {
					self::$app_params[$splited[0]] = isset($splited[1]) ? $splited[1] : "";
				}
			}
		}
	}

?>