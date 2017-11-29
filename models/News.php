<?php

class News extends Model
{
	public function add($title, $content, $date, $user_id)
	{
		$title = $this->db->escape($title);
		$content = $this->db->escape($content);
		$date = $this->db->escape($date);
		$user_id = (int)$user_id;

		$sql = "INSERT INTO $this->table_name (title, content, date, user_id) VALUES('$title', '$content', '$date', $user_id)";

		return $this->db->query($sql);
	}

}

?>