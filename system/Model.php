<?php

class Model
{
	protected $db;
	protected $table_name;

	function __construct($db = null, $table_name = null)
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
		$sql = "SELECT * FROM $table_name WHERE id=$id";
		return $this->db->query($sql);
	}

	public function deleteById($id)
	{
		$id = (int)$id;
		$sql = "DELETE FROM $table_name WHERE id=$id";
	}

	public function getAll()
	{
		$sql = "SELECT * FROM $this->table_name";
		return $this->db->query($sql);
	}

}

?>