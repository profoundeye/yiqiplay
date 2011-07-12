<?php
class Location{
	private $lid = -1;
	private $province = "";
	private $city = "";
	private $county = "";
	private $point = "";
	
	/*
	function location($province, $city, $county){
		if ($province == null) {$province = "";}
		if ($city == null) {$city = "";}
		if ($county == null) {$county = "";}
		
		$this->lid = hexdec(md5($province.$city.$county));
		$this->province = $province;
		$this->city = $city;
		$this->county = $county;
	}
	*/
	
	function setLid($lid){
		$this->lid = $lid;
	}
	
	function getLid(){
		return $this->lid;
	}
	
	function setProvince($province){
		$this->province = $province;
	}
	
	function getProvince(){
		return $this->province;
	}
	
	function setCity($city){
		$this->city = $city;
	}
	
	function getCity(){
		return $this->city;
	}
	
	function setCounty($county){
		$this->county = $county;
	}
	
	function getCounty(){
		return $this->county;
	}
	
	function setPoint($point){
		$this->point = $point;
	}
	
	function getPoint(){
		return $this->point;
	}
	
	function toString(){
		return "lid=".$this->lid.", province=".$this->province.", city="
			.$this->city.", county=".$this->county.", point=".$this->point;
	}
	
	public static function getLocationFromId($id, $provinces){
		$pid = floor($id/1000);
		$cid = $id - $pid*1000;
		$pid = isset($provinces[$pid])?pid:100;
		$pname = $provinces[$pid]['name'];
		
		if ($pid != 100) { // the pid is other place
			$cities = $provinces[$pid]['cities'];
			$cname = isset($cities[$cid])?$cities[$cid]:" ";
		} else {
			$cname = " ";
		}
		
		return array('province' => $pname, 'city'=>$cname);
	}
}
?>