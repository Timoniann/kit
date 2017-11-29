<?php

class Trainings extends Model
{
	public function add($name, $private, $subject_id, $user_id)
	{
		$name = $this->db->escape($name);
		$private = (bool) $private;
		$subject_id = (int) $subject_id;
		$user_id = (int) $user_id;

		$sql = "INSERT INTO $this->table_name (name, private, user_id, subject_id) VALUES('$name', '$private', $user_id, $subject_id)";

		return $this->db->query($sql);
	}
}

?>