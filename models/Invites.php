<?php

class Invites extends Model
{
	public function add($user_id, $training_id)
	{
		$user_id = (int)$user_id;
		$training_id = (int) $training_id;

		$sql = "INSERT INTO $this->table_name(user_id, training_id) VALUES($user_id, $training_id)";

		return $this->db->query($sql);
	}
}

?>