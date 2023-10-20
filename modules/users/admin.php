<?php
class module {
    private static $action;
    private static $id;
    private static $firstname;
    private static $lastname;
    private static $username;
    private static $email;
    private static $password;
    private static $opassword;
    private static $is_active;

    public function __construct(){
        self::$action = http::param("action");
        self::$id = http::param("id");
        self::$firstname = http::param("firstname");
        self::$lastname = http::param("lastname");
        self::$username = http::param("username");
        self::$email = http::param("email");
        self::$password = http::param("password");
        self::$opassword = http::param("opassword");
        self::$is_active = http::param("is_active");
    }

    public static function listing(){
        $data = DB::select("*");
        $data = DB::from("users");
        $data = DB::where(["is_role" =>  0]);
        $data = DB::sort("id","DESC");
        $data = DB::paging();
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function single(){
        $data = DB::select("*");
        $data = DB::from("users");
        $data = DB::where(["id" => self::$id]);
        $data = DB::execute();
        $data = DB::fetch("one");

        if(!$data){
            http::redirect("404");
        } else {
            return $data;
        }
    }

    public static function create() {
        if(self::$action == "create"){
            $data = DB::create("users", [
                "firstname" => self::$firstname,
                "lastname" => self::$lastname,
                "username" => self::$username,
                "email" => self::$email,
                "password" => md5(self::$password),
                "is_role" => 0,
                "is_active" => self::$is_active,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ])::execute();
    
            if($data){
                msg::set("1 row created successfuly","success");
                http::redirect("u-admins");
            }
        }
    }

    public static function update(){
        // Set old password if new password is empty
        $password = (empty(self::$password)) ? self::$opassword : md5(self::$password);
        
        if(self::$action == "update"){
            $data = DB::update("users", [
                "firstname" => self::$firstname,
                "lastname" => self::$lastname,
                "username" => self::$username,
                "email" => self::$email,
                "password" => $password,
                "is_active" => self::$is_active,
                "updated_at" => date('Y-m-d H:i:s')
            ]);
            $data = DB::where(["id" => self::$id]);
            $data = DB::execute();
    
            if($data){
                msg::set("1 row updated successfuly","success");
                http::redirect("u-admins");
            }
        }
    }

    public static function delete(){
        if(self::$action == "delete"){
            $data = DB::delete("users");
            $data = DB::where(["id" => self::$id]);
            $data = DB::execute();
            if($data){
                msg::set("1 row deleted successfuly","success");
            }
        }
    }

    public static function actions($id){
        echo '
          <div class="dropdown">
              <button class="btn btn-sm bx bx-dots-vertical-rounded shadow-none font-16" data-bs-toggle="dropdown"></button>
              <ul class="dropdown-menu shadow border-0">
                  <li>
                      <a class="dropdown-item" href="u-admin-details.php?id='.$id.'">
                          <span class="bx bx-show text-success align-middle"></span> Details 
                      </a>
                  </li>
                  <li>
                      <a class="dropdown-item" href="u-admin-update.php?id='.$id.'">
                          <span class="bx bx-edit text-success align-middle"></span> Update 
                      </a>
                  </li>
                  <li>
                      <a class="dropdown-item" href="u-admins.php?id='.$id.'&action=delete">
                          <span class="bx bx-trash text-danger align-middle"></span> Delete
                      </a>
                  </li>
              </ul>
          </div>';
    }
}
// Init class for construct values
$module = new module();
?>