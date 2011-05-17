<?php
include_once("..\storage\baseStorage.php"); 
include_once("..\data\message.php"); 
class MessageStorage extends BaseStorage{
	function insert($message){
		$sql = "insert into message values(DEFAULT, ".$message->getSnstype()
			.", '".$message->getSnsmid()."', '".$message->getSnsuid()."', '"
			.$message->getContent()."', ".$message->getUhomeid().", ".
			$message->getLocid().", '')";
		echo $sql;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$id = mysql_insert_id();
		$this->closeConn();
		if ($result) return $id;
		else return null;
	}
		
	function get($mid){
		$sql = "select * from message where mid=".$mid;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		$message = null;
		if($ret = mysql_fetch_array($result)) {
			$message = $this->translate($ret);
		}
		return $message;
		
	}
	
	function getAll(){
		$sql = "select * from message";
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		$messageArr = array();
		while($ret = mysql_fetch_array($result)) {
			array_push($messageArr, $this->translate($ret));
		}
		return $messageArr;
	}
	
	function update($message){
		$sql = "update message set snstype=".$message->getSnstype().", snsmid='"
			.$message->getSnsmid()."', snsuid='".$message->getSnsuid()."', content='"
			.$message->getContent()."', uhomeid=".$message->getUhomeid().", locid="
			.$message->getLocid()." where mid=".$message->getMid();
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		return $result;
	}
	
	function remove($mid){
		$sql = "delete from message where mid=".$mid;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		return $result;	
	}
	
	function translate($ret){
		$message = new Message();
		$message->setMid($ret["mid"]);
		$message->setSnstype($ret["snstype"]);
		$message->setSnsmid($ret["snsmid"]);
		$message->setSnsuid($ret["snsuid"]);
		$message->setContent($ret["content"]);
		$message->setUhomeid($ret["uhomeid"]);
		$message->setLocid($ret["locid"]);
		return $message;
	}
}
?>
