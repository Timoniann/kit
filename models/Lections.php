<?php

class Lections extends Model
{
	public function add($title, $content, $date, $training_id)
	{
		$title = $this->db->escape($title);
		$content = $this->db->escape($content);
		$date = $this->db->escape($date);
		$training_id = (int)$training_id;

		$sql = "INSERT INTO $this->table_name (title, content, date, training_id) VALUES('$title', '$content', '$date', $training_id)";

		return $this->db->query($sql);
	}

	public function getByTrainingId($id)
	{
		$id = (int)$id;
		$sql = "SELECT * FROM $this->table_name WHERE training_id=$id";
		return $this->db->query($sql);
	}
}

?>