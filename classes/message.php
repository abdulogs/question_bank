<?php

class msg{
    public static function set($message="", $type="success"){
		$_SESSION["message"] = $message; 
		$_SESSION["messagetype"] = $type;
	  }
  

    public static function get(){
		$message = "";
		if(isset($_SESSION["message"])){
			
			if($_SESSION["messagetype"] == "success"){
				$message ='
				<div class="alert alert-success alert-dismissible rounded-0 m-0">
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					<strong>Congratulation:</strong> '.$_SESSION["message"].'
				</div>';
			} else if ($_SESSION["messagetype"] == "error"){
				$message ='
				<div class="alert alert-danger alert-dismissible rounded-0 m-0">
					<button type="button" class="btn-close" data-bs-dismiss="alert"></button>
					<strong>Opps!</strong> '.$_SESSION["message"].'
				</div>';
			}
		
			// Unsetting the message or it's type 
			unset($_SESSION["message"]);
			unset($_SESSION["messagetype"]);

			echo $message;					
		}
	}

	public static function alert($value){
		echo "<script>alert('{$value}')</script>";
	}
}

?>