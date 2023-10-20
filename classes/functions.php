<?php
class f {
	public static function is_plural($val1, $val2){
		if($val1 <= 1){
		   return $val2;
		} else {
		   return $val2."s";
		}
   	}

	public static function is_active($value, $type="badge"){
		if($type =="badge"){
			if($value == 0){
				echo '<span class="badge bg-danger">Inactive</span>';
			 } else if($value == 1) {
				echo '<span class="badge bg-success">Active</span>';
			 }
		} else if($type =="option") {
			if($value == 0){
				echo '<option value="1">Yes</option><option value="0" selected>No</option>';
			 } else if($value == 1) {
				echo '<option value="1" selected>Yes</option><option value="0">No</option>';
			 }
		}
   	}

	public static function is_role($value){
		if($value == 0){
		   echo 'Admin';
		} else if($value == 1) {
		   echo 'Teacher';
		}
   	}

	public static function is_admin($redirect = False, $path = ""){
		return ($_SESSION["is_role"] == 0) ? true  : false;	
	}

	public static function is_teacher($redirect = False, $path = ""){
		return ($_SESSION["is_role"] == 1) ? true  : false;	
	}

	public static function attr($value, $attr){
		if(!empty($value)){
			return $attr;
		} else{
			return "";
		}	
	}

	public static function selected($val1, $val2, $type = "single"){
		if($type == "single"){
			if($val1 == $val2){
				return "selected";
			} else{
				return "";
			}	
		} else if($type == "multiple"){
			if(in_array(strval($val1), explode(",",$val2))){
				return "selected";
			} else{
				return "";
			}	
		}
	}

	public static function disabled($name){
		if(!$name){
			return "disabled";
		} else{
			return false;
		}	
	}

	public static function component($file){
		require_once "components/".$file.".php";
	}

	public static function module($file){
		require_once "modules/".$file.".php";
	}

	public static function active_page($page="", $class=""){
		$pagename = basename($_SERVER['PHP_SELF']);
		if (is_array($page)){
			foreach($page as $item){
				if($item.".php" == $pagename){
					echo $class;
				}
			}
		} else {
			if($page.".php" == $pagename){
				echo $class;
			}
		}
	}
}
?>