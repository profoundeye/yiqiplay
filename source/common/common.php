<?php
function randStr($length){
	$strtmp = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
	$str = "";
	for ($i=0; $i<$length; $i++){
		$rnd = rand(0,51);
		$str .= $strtmp[$rnd];
	}
	
	return $str;
}
?>