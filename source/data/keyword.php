<?php
class Keyword{
	private $kid;
	private $word;
	// the keyword is a location if $type=0, or an action if $type=1, or an event if $type=2
	private $type = 2;
	
	function setKid($kid) {
		$this->kid = $kid;
	}
	
	function getKid(){
		return $this->kid;
	}
	
	function setWord($word) {
		$this->word = $word;
	}
	
	function getWord(){
		return $this->word;
	}
	
	function setType($type) {
		$this->type = $type;
	}
	
	function getType(){
		return $this->type;
	}
	
	function toString(){
		return "kid=".$this->kid.", word=".$this->word.", type=".$this->type;
	}
}
?>