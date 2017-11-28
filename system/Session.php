<?php

class Session
{
	private static $flash_message;
	private static $color_message;// red, green, blue
	
	public static function setFlash($message, $color = "green")
	{
		self::$flash_message = $message;
		self::$color_message = $color;
	}

	public static function hasFlash()
	{
		return !is_null(self::$flash_message);
	}

	public static function showFlash()
	{
		$color = self::$color_message;
		//echo "<div style='color:{$color}'>";
		echo self::$flash_message;
		//echo "</div>";
		self::$flash_message = null;
	}

		public static function set($key, $value)
		{
			$_SESSION[$key] = $value;
		}

		public static function get($key)
		{
			if (isset($_SESSION[$key])) {
				return $_SESSION[$key];
			} else return null;
		}
		
		public static function delete($key)
		{
			if (isset($_SESSION[$key])) {
				unset($_SESSION[$key]);
			}
		}

		public static function destroy()
		{
			session_destroy();
		}


}

?>