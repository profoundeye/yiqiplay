<?php
abstract class BaseStorage{
	private $conn;
	private $host = "localhost";
	private $u = "root";
	private $p = "";
	private $database = "yiqiplay";
	
	protected function getConn(){
		$this->conn = mysql_connect($this->host, $this->u, $this->p);
		mysql_select_db($this->database, $this->conn);
		return $this->conn;
	}
	
	protected function closeConn(){
		mysql_close($this->conn);
	}

	abstract function insert($data);
	
	abstract function get($id);
	
	abstract function update($data);
	
	abstract function remove($id);
	
	abstract function translate($ret);
}
?>