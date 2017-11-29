<?php

class TrainingsController extends Controller
{

	private $table;
	public function init()
	{
		$this->table = new Trainings();
	}

	public function index()
	{
		$this->data = $this->table->getAll();
	}

	public function create()
	{
		$subject_table = new Subjects();
		$this->data["subjects"] = $subject_table->getAll();

		if (!empty($_POST)) {
			$name = $_POST['training_name'];
			$private = $_POST['training_type'] == "1" ? true : false;
			$subject_id = (int)$_POST['subject'];
			$user_id = Session::getCurrentUser()["id"];
			if($this->table->add($name, $private, $subject_id, $user_id)){
				Session::setFlash("Training created");
			} else Session::setFlash("Training not created");
		}
	}

	public function view()
	{
		if($this->params && count($this->params)){
			$id = (int)$this->params[0];
			$trainings = $this->table->getById($id);
			if (count($trainings)) {
				$this->data['training'] = $trainings[0];
				$users_table = new Users();
				$user = $users_table->getbyId($trainings[0]['user_id']);
				$this->data['user'] = $user[0];
				$this->data['user'];

				$lection_table = new Lections();
				$this->data['lections'] = $lection_table->getByTrainingId($id);
			}
		}
	}
}

?>