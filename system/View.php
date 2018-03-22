<?php

class View
{
	protected $data, $path;

	function __construct($data = array(), $path = null)
	{
		if (!$path) {
			$router = App::getRouter();
			$controller_dir = $router->getController();
			$template_name = $router->getMethodPrefix().$router->getAction().".html";
			$path = VIEWS . "/{$controller_dir}/{$template_name}";
		}
		$path = strtolower($path);
		if (!file_exists($path)) {
			// Redirect to 404 here
			throw new Exception("Template file not found in this path: " . $path);
		}
		$this->path = $path;
		$this->data = $data;
	}

	public function render()
	{
		$content = "";
		$data = $this->data;
		ob_start();
		include $this->path;
		$content .= ob_get_clean();
		return $content;
	}
}

?>