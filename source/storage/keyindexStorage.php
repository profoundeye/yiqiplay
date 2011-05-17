<?php
include_once("..\storage\baseStorage.php"); 
include_once("..\data\keyword.php"); 
class KeyindexStorage extends BaseStorage{

	function insert($keyindex){
		$sql = "insert into keyindex values('".$keyindex->getWord().
			"',".$keyindex->getMid().",".$keyindex->getUhomeid().","
			.$keyindex->getMlocid().",'')";
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		return $result;
	}
	
	function get($idarr){
		$sql = "select * from keyindex where word='".$idarr[0]."' and mid=".$idarr[1];
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		$keyword = null;
		if($ret = mysql_fetch_array($result)) {
			$keyindex = $this->translate($ret);
		}
		return $keyindex;
	}
	
	function getAll() {
		$sql = "select * from keyindex";
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		$keyindexArr = array();
		while($ret = mysql_fetch_array($result)) {
			array_push($keyindexArr, $this->translate($ret));
		}
		return $keyindexArr;
	}
	
	function update($keyindex){
		return null;
	}
	
	function remove($idarr){
		$sql = "delete from keyindex where word='".$idarr[0]."' and mid=".$idarr[1];
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		return $result;		
	}
	
	function translate($ret){
		$keyindex = new Keyindex();
		$keyindex->setWord($ret["word"]);
		$keyindex->setMid($ret["mid"]);
		$keyindex->setUhomeid($ret["uhomeid"]);
		$keyindex->setMlocid($ret["mlocid"]);
		return $keyindex;
	}

}
?>