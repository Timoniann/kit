<?php

class LectionsController extends Controller
{
	public function create()
	{
		$id = (int)$this->params[0];
		if (!empty($_POST) && $id) {
			$title = $_POST['lection_title'];
			$content = $_POST['lection_content'];
			if (!$title || !$content) {
				
			} else {
				$lection_table = new Lections();
				if($lection_table->add($title, $content, date('Y-m-d H:i:s'), $id))
					Session::setFlash("Lection added");
				else Session::setFlash("Lection not added");
			}
		}
	}
}

?>