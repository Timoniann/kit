<?php

class TrainingsController extends Controller
{

	private $table;
	public function init()
	{
		if(!Session::getCurrentUser()) 
			Router::redirect("/users/auth");
		$this->table = new Trainings();
	}

	public function index()
	{
		$entries_table = new Entries();
		$subject_table = new Subjects();
		$users_table = new Users();

		$trainings = $this->table->get(array('private' => 0));

		for ($i=0; $i < count($trainings); $i++) { 

			$subject = $subject_table->getById((int) $trainings[$i]['subject_id']);
			$trainings[$i]['subject_name'] = count($subject) ? $subject[0]['name'] : "Unknown";

			$user = $users_table->getById((int) $trainings[$i]['user_id']);
			$trainings[$i]['user_name'] = count($user) ? $user[0]['first_name'] . " " . $user[0]['last_name'] : "Unknown";

			$entry = $entries_table->get(array('user_id' => Session::getCurrentUser()['id'], 'training_id' => $trainings[$i]['id']));
			$trainings[$i]['in_progress'] = count($entry) ? true : false;

		}

		$invites_table = new Invites();
		$user = Session::getCurrentUser();
		$invites = $invites_table->get(array('user_id' => $user['id'], 'status' => 0));

		for ($i=0; $i < count($invites); $i++) { 
			$invites[$i]['training'] = $this->table->get(array('id' => $invites[$i]['training_id']))[0];
			$invites[$i]['training']['user'] = $users_table->get(array('id' => $invites[$i]['training']['user_id']))[0];
		}

		$entries = $entries_table->get(array('user_id' => $user['id']));
		$accepted_trainings = array();
		for ($i=0; $i < count($entries); $i++) { 
			$tr = $this->table->get(array('id' => $entries[$i]['training_id']));//, 'private' => 1
			if(count($tr)){
				$tr = $tr[0];
				$tr['user'] = $users_table->get(array('id' => $tr['user_id']))[0];
				array_push($accepted_trainings, $tr);
			}
		}

		$this->data['invites'] = $invites;
		$this->data["trainings"] = $trainings;
		$this->data['accepted_trainings'] = $accepted_trainings;
	}

	public function create()
	{
		if (!App::teacherPermission())
			Router::redirect("/trainings");

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
		if(!($this->params && count($this->params)))
			Router::redirect('/trainings');

		$users_table = new Users();
		$tests_table = new Tests();
		$lection_table = new Lections();

		$id = (int)$this->params[0];
		$trainings = $this->table->getById($id);
		if (!count($trainings)) 
			Router::redirect('/trainings');

		$this->data['training'] = $trainings[0];
		
		$user = $users_table->getbyId($trainings[0]['user_id']);
		$this->data['user'] = $user[0];
		$this->data['user'];

		$this->data['current_user'] = Session::getCurrentUser();

		$this->data['lections_count'] = $lection_table->count(array('training_id' => $id));

		$this->data['tests_count'] = $tests_table->count(array('training_id' => $id));
	

		if(App::adminPermission() || (App::teacherPermission() && ($data['training']['user_id'] == $data['current_user']['id']))) {
			$testings_table = new Testings();
			$tests = $tests_table->get(array('training_id' => $this->data['training']['id']));
			$testings = array();
			foreach ($tests as $test) {
				$new_testings = $testings_table->get(array('test_id' => $test['id']));
				for ($i=0; $i < count($new_testings); $i++) { 
					$new_testings[$i]['user'] = $users_table->get(array('id' => $new_testings[$i]['user_id']))[0];
					$new_testings[$i]['test'] = $test;
				}

				$testings = array_merge($testings, $new_testings);
			}
			$this->data['testings'] = $testings;
			
		}
	}

	public function edit()
	{
		if($this->params && count($this->params)){

			$id = (int)$this->params[0];
			$trainings = $this->table->getById($id);
			
			if (count($trainings)) {
				$trainings = $this->table->getById($id);
				$currentUser = Session::getCurrentUser();
				if ((!App::adminPermission() || !App::teacherPermission()) && ($currentUser['id'] != $trainings['0']['user_id'])){
					Session::setFlash("YOU CANT HACK ME)))", "danger");
					Router::redirect("/trainings");
				}

				if (!empty($_POST)) {

					if (isset($_POST['training_name'])) {
						$name = $_POST['training_name'];
						if($this->table->update($id, array("name" => $name)))
							Session::setFlash("Training name is updated");
						else
							Session::setFlash("Training name is not updated");
					}

					if (isset($_POST['training_type'])) {
						$private = $_POST['training_type'];
						if($this->table->update($id, array("private" => $private)))
							Session::setFlash("Training type is updated");
						else
							Session::setFlash("Training type is not updated");
					}

					if (isset($_POST['next_training'])) {
						$next_training = (int) $_POST['next_training'];
						if($this->table->update($id, array('next_training' => $next_training)))
							Session::setFlash("Next training changed");
						else
							Session::setFlash("Next training not changed");
					}

					$trainings = $this->table->getById($id);
				}

				$this->data['training'] = $trainings[0];
				$users_table = new Users();
				$user = $users_table->getbyId($trainings[0]['user_id']);
				$this->data['user'] = $user[0];
				$this->data['user'];

				$this->data['own_trainings'] = $this->table->get(array('user_id' => $user[0]['id']));

				$lection_table = new Lections();
				$this->data['lections'] = $lection_table->getByTrainingId($id);

				$tests_table = new Tests();
				$questions_table = new Questions();

				$tests = $tests_table->get(array('training_id' => $id));

				for ($i=0; $i < count($tests); $i++) { 
					$tests[$i]['questions'] = $questions_table->get(array('test_id' => $tests[$i]['id']));
				}

				$this->data['tests'] = $tests;
			} else Router::redirect("/trainings");
		} else Router::redirect("/trainings");
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
		$user = Session::getCurrentUser();

		if (!$user || !$this->params) Router::redirectToBack();

		$tests_table = new Tests();
		$entries_table = new Entries();
		$testings_table = new Testings();
		$lections_table = new Lections();
		$questions_table = new Questions();
		
		$entry = $entries_table->get(array('user_id' => Session::getCurrentUser()['id'], 'training_id' => $this->params[0]));
		if (!count($entry)) {
			Router::redirectToBack();
		}
		$entry = $entry[0];


		$this->table->getById($entry['training_id']);

		$this->data['training'] = $this->table->getById($entry['training_id'])[0];
		$this->data['lections'] = $lections_table->get(array('training_id' => $entry['training_id']));

		$tests = $tests_table->get(array('training_id' => $entry['training_id']));

		$questions = array();
		for ($i=0; $i < count($tests); $i++) {

			$testings = $testings_table->get(array('user_id' => $user['id'], 'test_id' => $tests[$i]['id']));
			$tests[$i]['testings'] = $testings;

			$questions = $questions_table->get(array('test_id' => $tests[$i]['id']));

			for ($j=0; $j < count($questions); $j++) { 
			 	$questions[$j]['variants'] = array();
			 	$allQuestions = array(
			 		$questions[$j]['answer'], 
			 		$questions[$j]['variant1'],
			 		$questions[$j]['variant2'],
			 		$questions[$j]['variant3']
			 	);
			 	$r = rand(0, 3);
			 	array_push($questions[$j]['variants'], $allQuestions[$r]);
			 	array_splice($allQuestions, $r, 1);
			 	$r = rand(0, 2);
			 	array_push($questions[$j]['variants'], $allQuestions[$r]);
			 	array_splice($allQuestions, $r, 1);
			 	$r = rand(0, 1);
			 	array_push($questions[$j]['variants'], $allQuestions[$r]);
			 	array_splice($allQuestions, $r, 1);
			 	array_push($questions[$j]['variants'], $allQuestions[0]);
			}
			$tests[$i]['questions'] = $questions;
		}


		$this->data['tests'] = $tests;
	}

	public function check_tests()
	{
		$user = Session::getCurrentUser();
		if (!empty($_POST) && $user) {

			if(isset($_POST['test_id'])){

				$test_id = (int)$_POST['test_id'];
				$tests_table = new Tests();
				$test = $tests_table->get(array('id' => $test_id));

				if(count($test)){

					$entries_table = new Entries();

					$test = $test[0];
					$training = $this->table->get(array('id' => $test['training_id']));
					$training = $training[0];

					if(count($entries_table->get(array('user_id' => $user['id'], 'training_id' => $training['id'])))){
						
						$answers_table = new Answers();
						$testings_table = new Testings();
						$questions_table = new Questions();

						$testings_table->add($user['id'], $test['id'], 0, 0);
						$testingId = $testings_table->getLastId();

						$answers = array();

						$questions = $questions_table->get(array('test_id' => $test['id']));

						$true_count = 0;
						$false_count = 0;

						foreach ($questions as $question) {

							if (!isset($_POST[$question['id']])) {
								$testings_table->update($testingId, array('questions_count' => -1, 'answered_count' => -1));
								Session::setFlash("Not all tests checked!");
								Router::redirectToBack();
							}

							if ($question['answer'] == $_POST[$question['id']]) {
								$answers_table->add($testingId, $question['id'], $_POST[$question['id']], 1);
								$true_count++;
							}
							else {
								$answers_table->add($testingId, $question['id'], $_POST[$question['id']], 0);
								$false_count++;
							}
						}

						$testings_table->update($testingId, array('questions_count' => $false_count + $true_count, 'answered_count' => $true_count));

						$flash = "Answered: " . $true_count . ", not answered: " . $false_count;
						Session::setFlash("Test '" . $test['title'] ."': " . "<div style='color:green; display: inline-block;'>Answered: " . $true_count . "</div><div style='color: red; display: inline-block;'>" . ", not answered: " . $false_count . "</div>");
					}
				}
			}
		}
		Router::redirectToBack();
	}

	public function invite()
	{
		$user = Session::getCurrentUser();
		if (!$user || !$this->params) Router::redirectToBack();

		$training = $this->table->get(array('id' => $this->params[0]));
		if(!count($training))
			Router::redirect('/trainings');

		$training = $training[0];
		
		$users_table = new Users();
		$users = $users_table->get();

		$invites_table = new Invites();
		$invites = $invites_table->get(array('training_id' => $training['id']));
		foreach ($invites as $invite) {
			for ($i=0; $i < count($users); $i++) { 
				if ($users[$i]['id'] == $invite['user_id']) {
					#$users[$i]['status'] = $invite['status'];
					$users[$i]['invite'] = $invite;
				}
			}
		}

		$this->data['training'] = $training;
		$this->data['invites'] = $invites;
		$this->data['users'] = $users;
	}
}

?>