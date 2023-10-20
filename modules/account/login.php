<?php
class module {
    public static $action;
    private static $email;
    private static $password;

    public function __construct(){
        self::$action = http::param("action");
        self::$email = http::param("email");
        self::$password = http::param("password");
    }

    public static function login(){
        if(self::$action == "login"){
            $user = DB::select("id","is_role");
            $user = DB::from("users");
            $user = DB::where(["email" => self::$email,"password" => md5(self::$password)]);
            $user = DB::execute();
            $user = DB::fetch("one");
            // Check
            if($user){
                // Set session
                session::set("id", $user["id"]);
                session::set("is_role", $user["is_role"]);
                // Message
                msg::set("Login successfuly!","success");
                // Redirect
                http::redirect("home");
            } else {
                // Message
                msg::set("Invalid credentials!","error");
                http::redirect("index");
            }
        }
    }
}

// Init class for construct values
$module = new module();
?>