<?php

class Testings extends Model
{
	public function add($user_id, $test_id, $questions_count, $answered_count)
	{
		$user_id = (int)$user_id;
		$test_id = (int)$test_id;
		$questions_count = (int)$questions_count;
		$answered_count = (int)$answered_count;
		$date = date('Y-m-d H:i:s');

		$sql = "INSERT INTO $this->table_name (user_id, test_id, questions_count, answered_count, date) VALUES('$user_id', '$test_id', '$questions_count', '$answered_count', '$date')";

		return $this->db->query($sql);
	}
}

?>