<?php

class UserController extends Controller
{
	private $user_model;

	public function init()
	{
		$this->user_model = new Users();
	}

	public function all()
	{
		$this->data["users"] = $this->user_model->getAll();
	}

	public function index()
	{
		
	}

}

?>