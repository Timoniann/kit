<?php

class Books extends Model
{
	public function add($title, $description, $author, $date, $file_name, $user_id, $subject_id)
	{
		$title = $this->db->escape($title);
		$description = $this->db->escape($description);
		$author = $this->db->escape($author);
		$date = $this->db->escape($date);
		$user_id = (int)$user_id;
		$subject_id = (int)$subject_id;

		$sql = "INSERT INTO $this->table_name (title, description, author, release_date, file_name, user_id, subject_id) VALUES('$title', '$description', '$author', '$date', '$file_name', $user_id, $subject_id)";

		return $this->db->query($sql);
	}

	public function search_by_author($author_name)
    {
        $author_name = $this->db->escape($author_name);

        $sql = "SELECT * FROM $this->table_name WHERE author LIKE '%$author_name%'";

        return $this->db->query($sql);
    }

    public function search_by_name($book_name)
    {
        $book_name = $this->db->escape($book_name);

        $sql = "SELECT * FROM $this->table_name WHERE title LIKE '%$book_name%'";

        return $this->db->query($sql);
    }
}


?>