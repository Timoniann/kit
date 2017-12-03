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

	public function search_by_author($author_name)
    {
        $author_name = $this->db->escape($author_name);

        $sql = "SELECT * FROM $this->table_name WHERE author LIKE '%$author_name%' ORDER BY id DESC";

        return $this->db->query($sql);
    }
}


?>