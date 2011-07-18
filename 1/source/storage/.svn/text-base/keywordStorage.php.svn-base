<?php
include_once("..\storage\baseStorage.php"); 
include_once("..\data\keyword.php"); 
class KeywordStorage extends BaseStorage{

	function insert($keyword){
		$sql = "insert into keyword values(DEFAULT,'"
			.$keyword->getWord()."',".$keyword->getType().",'')";
		echo $sql;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$id = mysql_insert_id();
		$this->closeConn();
		if ($result) return $id;
		else return null;
	}
	
	function get($kid){
		$sql = "select * from keyword where kid=".$kid;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		$keyword = null;
		if($ret = mysql_fetch_array($result)) {
			$keyword = $this->translate($ret);
		}
		return $keyword;
	}
	
	function getAll() {
		$sql = "select * from keyword";
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		$keywordArr = array();
		while($ret = mysql_fetch_array($result)) {
			array_push($keywordArr, $this->translate($ret));
		}
		return $keywordArr;
	}
	
	function update($keyword){
		$sql = "update keyword set word='".$keyword->getWord()."', type=".
			$keyword->getType()." where kid=".$keyword->getKid();
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		return $result;
	}
	
	function remove($kid){
		$sql = "delete from keyword where kid=".$kid;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		return $result;		
	}
	
	function translate($ret){
		$keyword = new Keyword();
		$keyword->setKid($ret["kid"]);
		$keyword->setWord($ret["word"]);
		$keyword->setType($ret["type"]);
		return $keyword;
	}
}
?>