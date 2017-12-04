<?php 

class Questions extends Model
{
	public function add($question, $answer, $variant1, $variant2, $variant3, $test_id)
	{
		$question = $this->db->escape($question);
		$answer = $this->db->escape($answer);
		$variant1 = $this->db->escape($variant1);
		$variant2 = $this->db->escape($variant2);
		$variant3 = $this->db->escape($variant3);
		$test_id = (int) $test_id;

		$sql = "INSERT INTO $this->table_name (question, answer, variant1, variant2, variant3, test_id) VALUES('$question', '$answer', '$variant1', '$variant2', '$variant3', $test_id)";

		return $this->db->query($sql);
	}
}

?>