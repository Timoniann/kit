<?php

class Answers extends Model
{
	public function add($testing_id, $question_id, $user_answer, $answered)
	{
		$testing_id = (int) $testing_id;
		$question_id = (int)$question_id;
		$user_answer = $this->db->escape($user_answer);
		$answered = (int)$answered;

		$sql = "INSERT INTO $this->table_name(testing_id, question_id, user_answer, answered) VALUES($testing_id, $question_id, '$user_answer', $answered)";
		return $this->db->query($sql);
	}
}

?>