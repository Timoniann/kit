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

    public function search_news($news_name, $addition = '')
    {
        $news_name = $this->db->escape($news_name);

        $sql = "SELECT * FROM $this->table_name WHERE title LIKE '%$news_name%' or content LIKE '%$news_name%' $addition";

        return $this->db->query($sql);
    }

    public function search_count($search)
    {
    	$search = $this->db->escape($search);

        $sql = "SELECT COUNT(*) FROM $this->table_name WHERE title LIKE '%$search%' or content LIKE '%$search%'";

        return $this->db->query($sql)[0]["COUNT(*)"];
    }

}

?>