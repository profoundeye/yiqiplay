<?php
class Keyindex{
	private $word = "";
	private $mid = -1;
	private $uhomeid = -1;
	private $mlocid = -1;
	
	function setWord($word) {
		$this->word = $word;
	}
	
	function getWord(){
		return $this->word;
	}
	
	function setMid($mid) {
		$this->mid = $mid;
	}
	
	function getMid(){
		return $this->mid;
	}
	
	function setUhomeid($uhomeid) {
		$this->uhomeid = $uhomeid;
	}
	
	function getUhomeid(){
		return $this->uhomeid;
	}
	
	function setMlocid($mlocid) {
		$this->mlocid = $mlocid;
	}
	
	function getMlocid(){
		return $this->mlocid;
	}

	function toString(){
		return "word=".$this->word.", mid=".$this->mid.", uhomeid=".$this->uhomeid
			.", mlocid=".$this->mlocid;
	}
}
?>