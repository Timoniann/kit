<?php

/**
* 
*/
class Comments extends Model
{
	public function add($user_id, $training_id, $content)
	{
		$user_id = (int) $user_id;
		$training_id = (int) $training_id;
		$content = $this->db->escape(htmlspecialchars($content));

		$sql = "INSERT INTO $this->table_name (user_id, training_id, content) VALUES ($user_id, $training_id, '$content')";

		return $this->db->query($sql);
	}

	public function getByTraining($training_id)
	{
		$training_id = (int) $training_id;
		$sql = "SELECT * FROM $this->table_name WHERE training_id=$training_id ORDER BY id DESC";
		return $this->db->query($sql);
	}
}


?>