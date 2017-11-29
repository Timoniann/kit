<?php

class Books extends Model
{
	public function add($title, $description, $author, $date, $file_name, $user_id)
	{
		$title = $this->db->escape($title);
		$description = $this->db->escape($description);
		$author = $this->db->escape($author);
		$date = $this->db->escape($date);
		$user_id = (int)$user_id;

		$sql = "INSERT INTO $this->table_name (title, description, author, release_date, file_name, user_id) VALUES('$title', '$description', '$author', '$date', '$file_name', $user_id)";

		return $this->db->query($sql);
	}
}

?>