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

	public function get($array = array())
	{
		$where = "";
		if (count($array)) {
			$where = "WHERE ";
			foreach ($array as $key => $value) {
				$value = $this->db->escape($value);
				$where .= " $key='$value' AND ";
			}
			$where = substr($where, 0, -4);
		}

		$sql = "SELECT * FROM $this->table_name $where";

		return $this->db->query($sql);
	}

	public function getLike($where_array = array(), $addition = '')
	{
		$where = "";
		if (count($where_array)) {
			$where = "WHERE ";
			foreach ($where_array as $key => $value) {
				$value = $this->db->escape($value);
				$where .= " $key LIKE '%$value%' AND ";
			}
			$where = substr($where, 0, -4);
		}

		$sql = "SELECT * FROM $this->table_name $where $addition";

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

	public function update($id, $array)
	{
		$id = (int)$id;
		$setts = "SET ";
		if (count($array)) {
			foreach ($array as $key => $value) {
				$value = $this->db->escape($value);
				$setts .= " `$key`='$value', ";
			}
			$setts = substr($setts, 0, -2);
		} else return;

		$sql = "UPDATE $this->table_name $setts WHERE id=$id";
		return $this->db->query($sql);
	}

	public function count($where_array = array())
	{
		$where = "";
		if (count($where_array)) {
			$where = "WHERE ";
			foreach ($where_array as $key => $value) {
				$value = $this->db->escape($value);
				$where .= " $key='$value' AND ";
			}
			$where = substr($where, 0, -4);
		}

		$sql = "SELECT COUNT(*) FROM $this->table_name $where";
		return $this->db->query($sql)[0]["COUNT(*)"];
	}

	public function getLastId()
	{
		return $this->db->getConnection()->insert_id;
	}

}

?>