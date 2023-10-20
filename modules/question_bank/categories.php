<?php
class module {
    public static $action;
    private static $id;
    private static $name;
    private static $statement;
    private static $ordering;
    private static $teacher_id;
    private static $is_active;

    public function __construct(){
        self::$action = http::param("action");
        self::$id = http::param("id");
        self::$name = http::param("name");
        self::$statement = http::param("statement");
        self::$ordering = http::param("ordering");
        self::$teacher_id = http::param("teacher_id");
        self::$is_active = http::param("is_active");
    }

    public static function listing(){
        $data = DB::select("c.id", "c.name","c.ordering", "c.is_active", "c.created_at");
        $data = DB::select("c.updated_at", "u.firstname", "u.lastname", "c.statement");
        $data = DB::from("categories AS c");
        $data = DB::leftJoin("users AS u", "u.id","c.created_by");
        $data = DB::sort("id","DESC");
        $data = DB::paging();
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function single(){
        $data = DB::select("*");
        $data = DB::from("categories");
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
            $data = DB::create("categories", [
                "name" => self::$name,
                "statement" => self::$statement,
                "ordering" => self::$ordering,
                "is_active" => self::$is_active,
                "created_by" => self::$teacher_id,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ])::execute();
    
            if($data){
                msg::set("1 row created successfuly","success");
                http::redirect("categories");
            }
        }
    }

    public static function update(){
        if(self::$action == "update"){
            $data = DB::update("categories", [
                "name" => self::$name,
                "statement" => self::$statement,
                "ordering" => self::$ordering,
                "is_active" => self::$is_active,
                "created_by" => self::$teacher_id,
                "updated_at" => date('Y-m-d H:i:s')
            ]);
            $data = DB::where(["id" => self::$id]);
            $data = DB::execute();
    
            if($data){
                msg::set("1 row updated successfuly","success");
                http::redirect("categories");
            }
        }
    }

    public static function delete(){
        if(self::$action == "delete"){
            $data = DB::delete("categories");
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
                    <a class="dropdown-item" href="category-details.php?id='.$id.'">
                        <span class="bx bx-show text-success align-middle"></span> Details 
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="category-update.php?id='.$id.'">
                        <span class="bx bx-edit text-success align-middle"></span> Update 
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="categories.php?id='.$id.'&action=delete">
                        <span class="bx bx-trash text-danger align-middle"></span> Delete
                    </a>
                </li>
            </ul>
        </div>';
    }

    // Extras
    public static function teachers(){
        $data = DB::select("id","firstname","lastname");
        $data = DB::from("users");
        if(f::is_teacher()){
            $data = DB::where(["is_role" => 1, "is_active" => true, "id" => session::get("id")]);
        } else {
            $data = DB::where(["is_role" => 1, "is_active" => true]);
        }  
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }
}
// Init class for construct values
$module = new module();
?>