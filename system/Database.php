<?php

class Database
{
	private $host, $login, $password, $name;
	protected $connection;

	function __construct($host, $login, $password, $name)
	{
		$this->host 	= $host;
		$this->login 	= $login;
		$this->password = $password;
		$this->name 	= $name;
		
		$this->connection = new mysqli($host, $login, $password, $name);
		if ($this->connection == null) {
			exit();
		}
		if (!$this->connection->set_charset("utf8")) {
			printf("Error loading character set utf8: %s\n", $this->connection->error);
		}

		if (mysqli_connect_error()) {
			throw new Exception("Could not connect to Database");
		}
	}

	public function query($sql)
	{
		if (!$this->connection) return false;
		
		$result = $this->connection->query($sql);
		//echo $this->error() . "$sql";
		if ($this->error()) throw new Exception($this->connection);
		if (is_bool($result)) return $result;

		$data = array();
		while ($row = mysqli_fetch_assoc($result)) 
			array_push($data, $row);
		return $data;
	}

	public function escape($str)
	{
		return mysqli_escape_string($this->connection, $str);
	}

	public function error()
	{
		return $this->connection->error;
	}

	public function getConnection()
	{
		return $this->connection;
	}

}

?>