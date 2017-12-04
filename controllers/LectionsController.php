<?php

class LectionsController extends Controller
{
	public function create()
	{

		if (empty($_POST) || !isset($_POST['lection_title']) || !isset($_POST['lection_content']) || !isset($_POST['training_id'])) {
			Session::setFlash("LectionController getted wrong POST request");
			Router::redirectToBack();
		}

		$title = $_POST['lection_title'];
		$content = $_POST['lection_content'];
		$training_id = $_POST['training_id'];
	
		$lection_table = new Lections();

		if($lection_table->add($title, $content, date('Y-m-d H:i:s'), $training_id))
			Session::setFlash("Lection added");
		else 
			Session::setFlash("Lection not added");

		Router::redirectToBack();
	}

	public function edit()
	{
		if (empty($_POST) || !isset($_POST['lection_id']) || !isset($_POST['lection_content'])) {
			Session::setFlash("LectionController getted wrong POST request");
			Router::redirectToBack();
		}

		$content = $_POST['lection_content'];
		$id = $_POST['lection_id'];
	
		$lection_table = new Lections();

		if ($lection_table->update($id, array("content" => $content)))
			Session::setFlash("Lection edited");
		else 
			Session::setFlash("Lection not edited");

		Router::redirectToBack();
	}
}

?>