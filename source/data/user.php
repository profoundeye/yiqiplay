<?php
class User{
	private $uid;
	private $username = "";
	private $password = "";
	private $isregister = 0;
	private $gender = 2;
	private $age = 0;
	private $birthday = 0;
	private $homeid = -1;
	private $snstype = 0;
	private $snsuid = "";
	private $snsnick = "";
	private $snsproimg = "";
	private $extend = "";
	
	function getProfileUrl(){
		if ($this->snstype == SNSTYPE_SINA) {
			return SINA_BASEURL.$this->snsuid;
		}
	}

	function setUid($uid){
		$this->uid = $uid;
	}

	function getUid(){
		return $this->uid;
	}

	function setUsername($username){
		$this->username = $username;
	}

	function getUsername(){
		return $this->username;
	}
	
	function setPassword($password){
		$this->password = $password;
	}
	
	function getPassword(){
		return $this->password;
	}

	function setIsregister($isregister){
		$this->isregister = $isregister;
	}

	function getIsregister(){
		return $this->isregister;
	}

	function setGender($gender){
		$this->gender = $gender;
	}

	function getGender(){
		return $this->gender;
	}
	
	function setAge($age){
		return $this->age = $age;
	}

	function getAge(){
		return $this->age;
	}

	function setBirthday($birthday){
		$this->birthday = $birthday;
	}

	function getBirthday(){
		return $this->birthday;
	}

	function setHomeid($homeid){
		$this->homeid = $homeid;
	}

	function getHomeid(){
		return $this->homeid;
	}

	function getSnstype(){
		return $this->snstype;
	}

	function setSnstype($snstype){
		$this->snstype = $snstype;
	}

	function getSnsuid(){
		return $this->snsuid;
	}

	function setSnsuid($snsuid){
		$this->snsuid = $snsuid;
	}
	
	function getSnsnick(){
		return $this->snsnick;
	}
	
	function setSnsnick($snsnick){
		$this->snsnick = $snsnick;
	}
	
	function getSnsproimg(){
		return $this->snsproimg;
	}
	
	function setSnsproimg($snsproimg){
		$this->snsproimg = $snsproimg;
	}
	function getExtend(){ // add by will.zhang , 微博用户的原始数据存入Extend字段
		return $this->extend;
	}

	function setExtend($extend){
		$this->extend = $extend;
	}
	
	function toString(){
		return "uid=".$this->uid.", username=".$this->username.", password="
			.$this->password.", isregister=".$this->isregister.", gender=".$this->gender
			.", age=".$this->age.", birthday=".$this->birthday.", homeid=".$this->homeid
			.", snstype=".$this->snstype.", snsuid=".$this->snsuid;
	}

}
?>