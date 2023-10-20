<?php

class http extends config {

    public static function param($value, $alt = null){
		if(isset($_GET[$value])){
			return $_GET[$value];
		} else if(isset($_POST[$value])) {
			return $_POST[$value];
		} else {
			return $alt;
		}	
	}

	public static function get($val1, $val2 = null){
		if(isset($_GET[$val1])){
			return $_GET[$val1];
		} else{
			return $val2;
		}	
	}

	public static function post($val1, $val2 = null){
		if(isset($_POST[$val1])){
			return $_POST[$val1];
		} else{
			return $val2;
		}	
	}

    public static function reload($time =""){
		if (empty($time)) {
			echo "<script>location.reload();</script>";
		} else if(!empty($time)) {
		  echo "<script>setTimeout(function() { location.reload();}, {$time});</script>";
		}
	}

	public static function redirect($path){
		$url = parent::$url.$path.".php";
		header("location: {$url}");
	}
}

?>