<?php

class TestingsController extends Controller
{
	private $user;
	public function init()
	{
		$this->user = Session::getCurrentUser();
		if (!$this->user)
			Router::redirect('/trainings');
	}

	public function view()
	{
		if (count($this->params) < 1)
			Router::redirect('/trainings');

		$questions_table = new Questions();
		$trainings_table = new Trainings();
		$testings_table = new Testings();
		$answers_table = new Answers();
		$tests_table = new Tests();

		$testing = $testings_table->get(array('id' => (int)$this->params[0]));
		if (!count($testing)) {
			Router::redirect('/trainings');
		}

		$testing = $testing[0];
		$user_id = $testing['user_id'];

		$test = $tests_table->get(array('id' => $testing['test_id']));
		if (!count($test)) {

			Router::redirect('/trainings');
		}
		$test = $test[0];

		$training = $trainings_table->get(array('id' => $test['training_id']));
		if (!count($training)) {
			Router::redirect('/trainings');
		}
		$training = $training[0];

		if ($user_id == $this->user['id'] || $user_id == $training['user_id'] || App::adminPermission()) {
			$answers = $answers_table->get(array('testing_id' => $testing['id']));
			for ($i=0; $i < count($answers); $i++) { 
				$question = $questions_table->get(array('id' => $answers[$i]['question_id']))[0];
				$answers[$i]['question'] = $question;
			}
			$this->data['answers'] = $answers;
		} else
			Router::redirect('/trainings');
	}
}

?>