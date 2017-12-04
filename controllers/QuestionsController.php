<?php 

class QuestionsController extends Controller
{
	public function init()
	{
		
	}

	public function create()
	{
		if (empty($_POST) 
			|| !isset($_POST['question_question']) 
			|| !isset($_POST['question_answer']) 
			|| !isset($_POST['question_variant1']) 
			|| !isset($_POST['question_variant2']) 
			|| !isset($_POST['question_variant3']) 
			|| !isset($_POST['test_id'])
		) {
			Session::setFlash("QuestionsController getted wrong POST request");
			Router::redirectToBack();
		}

		$question = $_POST['question_question'];
		$question_answer = $_POST['question_answer'];
		$question_variant1 = $_POST['question_variant1'];
		$question_variant2 = $_POST['question_variant2'];
		$question_variant3 = $_POST['question_variant3'];
		$test_id = $_POST['test_id'];
	
		$questions_table = new Questions();

		if($questions_table->add($question, $question_answer, $question_variant1, $question_variant2, $question_variant3, $test_id))
			Session::setFlash("Question is added");
		else 
			Session::setFlash("Question is not added");
		Router::redirectToBack();
	}

	public function edit()
	{
		if (empty($_POST) 
			|| !isset($_POST['question_question']) 
			|| !isset($_POST['question_answer']) 
			|| !isset($_POST['question_variant1']) 
			|| !isset($_POST['question_variant2']) 
			|| !isset($_POST['question_variant3']) 
			|| !isset($_POST['question_id'])
		) {
			Session::setFlash("QuestionsController getted wrong POST request");
			Router::redirectToBack();
		}

		$question = $_POST['question_question'];
		$question_answer = $_POST['question_answer'];
		$question_variant1 = $_POST['question_variant1'];
		$question_variant2 = $_POST['question_variant2'];
		$question_variant3 = $_POST['question_variant3'];
		$question_id = $_POST['question_id'];
	
		$questions_table = new Questions();

		if($questions_table->update($question_id, array("question" => $question, "answer" => $question_answer, "variant1" => $question_variant1, "variant2" => $question_variant2, "variant3" => $question_variant3)))
			Session::setFlash("Question is edited");
		else 
			Session::setFlash("Question is not edited");
		Router::redirectToBack();
		
	}

}

 ?>