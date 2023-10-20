<?php

class middleware extends config {
    public static function login($value, $path = ""){
        if (isset($_SESSION[$value])) {
            http::redirect($path);
        }
    }
    
    public static function logout($value, $path = ""){
        if (!isset($_SESSION[$value])) {
            http::redirect($path);
        }
    }


    public static function is_admin($path){
        if($_SESSION["is_role"] == 0){
            http::redirect($path);
        }
    }

    public static function is_teacher($path){
        if($_SESSION["is_role"] == 1){
            http::redirect($path);
        }
    }
}



?>