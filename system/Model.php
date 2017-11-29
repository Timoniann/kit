<?php

class Model
{
	protected $db, $table_name;

	function __construct($table_name = null, $db = null)
	{
		$this->db = $db ? $db : Config::getDatabase();
		$this->table_name = $table_name ? $table_name : strtolower(get_class($this));
	}

	public function setTableName($table_name)
	{
		$this->table_name = $table_name;
	}

	public function getById($id)
	{
		$sql = "SELECT * FROM $this->table_name WHERE id=$id";
		return $this->db->query($sql);
	}

	public function deleteById($id)
	{
		$id = (int)$id;
		$sql = "DELETE FROM $this->table_name WHERE id=$id";
		return $this->db->query($sql);
	}

	public function getAll()
	{
		$sql = "SELECT * FROM $this->table_name";
		return $this->db->query($sql);
	}

}

?>