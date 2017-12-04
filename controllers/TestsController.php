<?php 

class TestsController extends Controller
{
	public function init()
	{
		
	}

	public function create()
	{
		if (empty($_POST) || !isset($_POST['test_title']) || !isset($_POST['training_id'])) {
			Session::setFlash("TestsController getted wrong POST request");
			Router::redirectToBack();
		}

		$title = $_POST['test_title'];
		$training_id = $_POST['training_id'];
	
		$tests_table = new Tests();
		if($tests_table->add($title, $training_id))
			Session::setFlash("Test is added");
		else 
			Session::setFlash("Test is not added");
		Router::redirectToBack();
	}
}

 ?>