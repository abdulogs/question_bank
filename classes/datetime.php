<?php

class DT {
    public static function format($datetime = "Y-m-d - h:i a", $pattern = "F d, Y h:i A"){
		return date($pattern, strtotime($datetime));
	}
}

?>