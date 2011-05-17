<?php
class Message{
	private $mid;
	private $snstype = 0;
	private $snsmid = "";
	private $snsuid = "";
	private $content = "";
	private $uhomeid = -1;
	private $locid = -1;
	
	function setMid($mid){
		$this->mid = $mid;
	}
	
	function getMid(){
		return $this->mid;
	}
	
	function setSnstype($snstype){
		$this->snstype = $snstype;
	}
	
	function getSnstype(){
		return $this->snstype;
	}
	
	function setSnsmid($snsmid){
		$this->snsmid = $snsmid;
	}
	
	function getSnsmid(){
		return $this->snsmid;
	}
	
	function setSnsuid($snsuid){
		$this->snsuid = $snsuid;
	}
	
	function getSnsuid(){
		return $this->snsuid;
	}
	
	function setContent($content){
		$this->content = $content;
	}
	
	function getContent(){
		return $this->content;
	}
	
	function setUhomeid($uhomeid){
		$this->uhomeid = $uhomeid;
	}
	
	function getUhomeid(){
		return $this->uhomeid;
	}
	
	function setLocid($locid){
		$this->locid = $locid;
	}
	
	function getLocid(){
		return $this->locid;
	}
	
	function toString(){
		return "mid=".$this->mid.", snstype=".$this->snstype.", snsmid=".$this->snsmid
			.", snsuid=".$this->snsuid.", content=".$this->content.", uhomeid=".$this->uhomeid
			.", locid=".$this->locid;
	}
}
?>