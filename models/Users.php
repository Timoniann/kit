<?php

class Users extends Model
{
	public function add($email, $password, $first_name, $last_name)
	{
		$email = $this->db->escape($email);
		$password = $this->db->escape($password);
		$first_name = $this->db->escape($first_name);
		$last_name = $this->db->escape($last_name);
		$sql = "INSERT INTO $this->table_name (email, password, first_name, last_name) VALUES('$email', '$password', '$first_name', '$last_name')";
		return $this->db->query($sql);
	}

	public function getByEmailAndPassword($email, $password)
	{
		$email = $this->db->escape($email);
		$sql = "SELECT * FROM $this->table_name WHERE email='$email' AND password='$password'";
		return $this->db->query($sql);
	}

}

?>