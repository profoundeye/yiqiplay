<?php
include_once("..\storage\baseStorage.php"); 
include_once("..\data\location.php"); 
class LocationStorage extends BaseStorage{
	
	function insert($location){
		$sql = "insert into location values(DEFAULT, '".
			$location->getProvince()."' , '".$location->getCity()
			."' , '".$location->getCounty()."' , '".$location->getPoint()."' , '')";
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		return $result;
	}

	function get($lid){
		$sql = "select * from location where lid=".$lid;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		$location = null;
		if($ret = mysql_fetch_array($result)) {
			$location = $this->translate($ret);
		}
		return $location;
	}
	
	function getAll(){
		$sql = "select * from location";
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		$locationArr = array();
		while($ret = mysql_fetch_array($result)) {
			array_push($locationArr, $this->translate($ret));
		}
		return $locationArr;
	}
	
	function update($location){
		$sql = "update location set province='".$location->getProvince().
			"', city='".$location->getCity()."', county='".$location->getCounty()
			."', point='".$location->getPoint()."' where lid=".$location->getLid();
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		return $result;
	}
	
	function remove($lid){
		$sql = "delete from location where lid=".$lid;
		$conn = $this->getConn();		
		$result = mysql_query($sql, $conn);
		$this->closeConn();
		return $result;
	}
	
	function translate($ret){
		$location = new Location();
		$location->setLid($ret["lid"]);
		$location->setProvince($ret["province"]);
		$location->setCity($ret["city"]);
		$location->setCounty($ret["county"]);
		$location->setPoint($ret["point"]);
		return $location;
	}
}
?>