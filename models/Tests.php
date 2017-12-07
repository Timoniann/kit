<?php

class Tests extends Model
{
	public function add($title, $training_id)
	{
		$title = $this->db->escape($title);
		$training_id = (int) $training_id;

		$sql = "INSERT INTO $this->table_name (title, training_id) VALUES('$title', '$training_id')";

		return $this->db->query($sql);
	}
}

?>