<?php

/**
* 
*/
class Controller
{
	protected $data, $params;

	function __construct($data = array())
	{
		$this->data = $data;
		$this->params = App::getRouter()->getParams();
	}

	public function setParams($params)
	{
		$this->params = $params;
	}

	public function getData()
	{
		return $this->data;
	}
}

?>