<?php

class Session
{
	private static $flash_message;
	private static $type_message;// info, danger, warning...
	
	public static function setFlash($message, $type = "info")
	{
		self::$flash_message = $message;
		self::$type_message = $type;
		self::set("message", $message);
		self::set("type", $type);
	}

	public static function hasFlash()
	{
		self::$flash_message = self::$flash_message == null ? self::get("message") : self::$flash_message;
		return !is_null(self::$flash_message);
	}

	public static function showFlash()
	{
		self::$flash_message = self::$flash_message ? self::$flash_message : get("message");

		echo self::$flash_message;
		
		self::$flash_message = null;
		self::delete("message");
		self::delete("type");
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

	public static function getCurrentUser()
	{
		$user_id = self::get("user_id");
		if ($user_id == null) return null;
		$users_model = new Users();
		$user = $users_model->getById($user_id);
		if(count($user))
			return $user[0];
		return null;
	}


}

?>