<?php

class TrainingsController extends Controller
{

	private $table;
	public function init()
	{
		if(!Session::getCurrentUser()) Router::redirect("/users/auth");
		$this->table = new Trainings();
	}

	public function index()
	{
		$entries_table = new Entries();
		$subject_table = new Subjects();
		$users_table = new Users();

		$trainings = $this->table->getAll();

		for ($i=0; $i < count($trainings); $i++) { 

			$subject = $subject_table->getById((int) $trainings[$i]['subject_id']);
			$trainings[$i]['subject_name'] = count($subject) ? $subject[0]['name'] : "Unknown";

			$user = $users_table->getById((int) $trainings[$i]['user_id']);
			$trainings[$i]['user_name'] = count($user) ? $user[0]['first_name'] . " " . $user[0]['last_name'] : "Unknown";

			$entry = $entries_table->get(array('user_id' => Session::getCurrentUser()['id'], 'training_id' => $trainings[$i]['id']));
			$trainings[$i]['in_progress'] = count($entry) ? true : false;

		}
		$this->data["trainings"] = $trainings;
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

	public function entry()
	{
		$entry_table = new Entries();

		$user = Session::getCurrentUser();

		if (!count($this->params)) Router::redirectToBack();

		if($entry_table->add($user['id'], $this->params[0]))
			Router::redirect("/trainings/view/{$this->params[0]}");
		else {
			Session::setFlash("Sorry, some problems");
			Router::redirectToBack();
		}

	}

	public function study()
	{
		if (!$this->params) Router::redirectToBack();

		$entries_table = new Entries();
		$lections_table = new Lections();
		
		$entry = $entries_table->get(array('user_id' => Session::getCurrentUser()['id'], 'training_id' => $this->params[0]));
		if (!count($entry)) {
			Router::redirectToBack();
		}
		$entry = $entry[0];


		$this->table->getById($entry['training_id']);

		$this->data['training'] = $this->table->getById($entry['training_id'])[0];
		$this->data['lections'] = $lections_table->get(array('training_id' => $entry['training_id']));
	}
}

?>