<?php

/**
* 
*/
class Subjects extends Model
{
	public function add($name, $description)
	{
		$name = $this->db->escape($name);
		$description = $this->db->escape($description);

		$sql = "INSERT INTO $this->table_name (name, description) VALUES('$name', '$description')";

		return $this->db->query($sql);
	}
}

?>