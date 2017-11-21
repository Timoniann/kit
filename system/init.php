<?php

	function __autoload($class_name)
	{
		$system_path 		= ROOT.'/system/'.$class_name.'.php';
		$controllers_path 	= ROOT.'/controllers/' . $class_name.'.php';
		$model_path 		= ROOT.'/models/'.$class_name.'.php';

		if (file_exists($system_path)) {
			require_once $system_path;
		} elseif (file_exists($controllers_path)) {
			require_once $controllers_path;
		} elseif (file_exists($model_path)) {
			require_once $model_path;
		} else{
			throw new Exception("Failed to include class :" . $class_name.". Path: ".$controllers_path);
		}
	}

?>