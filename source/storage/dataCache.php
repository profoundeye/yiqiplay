<?php
include_once("..\common\common.php"); 
class DataCache{
	private $host = "127.0.0.1";
	private $port = "11211";
	
	private function getCache(){
		$memcache = new Memcache();
		$memcache->connect($this->host, $this->port);
		return $memcache;
	}
	
	function getVersion(){
		$memcache = $this->getCache();
		return $memcache->getVersion();
	}
	
	function set($key, $obj, $exptime=0) {
		$memcache = $this->getCache();
		if($exptime == null){
			$exptime = 0;
		}
		$memcache->set($key, $obj, 0, $exptime);
	}
	
	function get($key) {
		$memcache = $this->getCache();
		return $memcache->get($key);
	}
	
	function delete($key) {
		$memcache = $this->getCache();
		$memcache->delete($key);
	}
}
?>