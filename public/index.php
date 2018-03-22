<?php

	define("ROOT", dirname(dirname(__FILE__)));//dirname(dirname(__FILE__))

	echo "ROOT: " . ROOT;

	define("SYSTEM", ROOT . "/system");
	define("VIEWS", ROOT . "/views");

	session_start();
	
	require_once(ROOT . "/system" . "/init.php");

	Config::init();

	App::run($_SERVER['REQUEST_URI']);

?>