<?php

/**
* 
*/
class SubjectsController extends Controller
{

	private $subject_table;
	public function init()
	{
		$this->subject_table = new Subjects();
	}

	public function index()
	{
		$this->data['subjects'] = $this->subject_table->getAll();
	}

	public function create()
	{
        if (!App::teacherPermission()) {
            Session::setFlash("Your access level does not match the required", "danger");
            Router::redirect("/subjects");
        }

		if (!empty($_POST)) {
			$name = $_POST['name'];
			$description = $_POST['description'];
			if (!$name || !$description) {
				return;
			}
			if($this->subject_table->add($name, $description))
				Session::setFlash("Subject is added");
			else 
				Session::setFlash("Subject is not added");
		}
	}

	public function view()
	{
		if($this->params && count($this->params)){
			$id = (int)$this->params[0];
			$subject = $this->subject_table->getById($id);
			if (count($subject)) {
				$this->data = $subject[0];
			}
		}
	}
}

?>