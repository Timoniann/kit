<?php

	define("ROOT", dirname(dirname(__FILE__)));
	define("SYSTEM", ROOT . "/system");
	define("VIEWS", ROOT . "/views");

	session_start();
	
	require_once SYSTEM . "/init.php";

	Config::init();

	App::run($_SERVER['REQUEST_URI']);

?>