<?php
class module {
    private static $action;
    private static $id;
    private static $name;
    private static $is_active;

    public function __construct(){
        self::$action = http::param("action");
        self::$id = http::param("id");
        self::$name = http::param("name");
        self::$is_active = http::param("is_active");
    }

    public static function listing(){
        $data = DB::select("c.id", "c.name", "c.is_active", "c.created_at", "c.updated_at");
        $data = DB::select("u.firstname", "u.lastname");
        $data = DB::from("classes AS c");
        $data = DB::leftJoin("users AS u", "u.id","c.created_by");
        $data = DB::sort("id","DESC");
        $data = DB::paging();
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function single(){
        $data = DB::select("c.id", "c.name", "c.is_active", "c.created_at", "c.updated_at");
        $data = DB::select("u.firstname", "u.lastname");
        $data = DB::from("classes AS c");
        $data = DB::leftJoin("users AS u", "u.id","c.created_by");
        $data = DB::where(["c.id" => self::$id]);
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
            $data = DB::create("classes", [
                "name" => self::$name,
                "is_active" => self::$is_active,
                "created_by" => session::get("id"),
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ])::execute();
    
            if($data){
                msg::set("1 row created successfuly","success");
                http::redirect("classes");
            }
        }
    }

    public static function update(){
        if(self::$action == "update"){
            $data = DB::update("classes", [
                "name" => self::$name,
                "is_active" => self::$is_active,
                "updated_at" => date('Y-m-d H:i:s')
            ]);
            $data = DB::where(["id" => self::$id]);
            $data = DB::execute();
    
            if($data){
                msg::set("1 row updated successfuly","success");
                http::redirect("classes");
            }
        }
    }

    public static function delete(){
        if(self::$action == "delete"){
            $data = DB::delete("classes");
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
                    <a class="dropdown-item" href="class-details.php?id='.$id.'">
                        <span class="bx bx-show text-success align-middle"></span> Details 
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="class-update.php?id='.$id.'">
                        <span class="bx bx-edit text-success align-middle"></span> Update 
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="classes.php?id='.$id.'&action=delete">
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