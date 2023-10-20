<?php
class module {
    public static $action;
    private static $id;
    private static $class_id;
    private static $subject_id;
    private static $teacher_id;
    private static $is_active;

    public function __construct(){
        self::$action = http::param("action");
        self::$id = http::param("id");
        self::$class_id = http::param("class_id");
        self::$subject_id = http::param("subject_id");
        self::$teacher_id = http::param("teacher_id");
        self::$is_active = http::param("is_active");
    }

    public static function listing(){
        $data = DB::select("a.id","a.is_active","a.created_at","a.updated_at");
        $data = DB::select("u.firstname", "u.lastname","c.name AS class","s.name AS subject");
        $data = DB::from("assign_cs AS a");
        $data = DB::leftJoin("users AS u", "u.id","a.teacher_id");
        $data = DB::leftJoin("classes AS c", "c.id","a.class_id");
        $data = DB::leftJoin("subjects AS s", "s.id","a.subject_id");
        $data = DB::sort("a.id","DESC");
        $data = DB::paging();
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function single(){
        $data = DB::select("a.id","a.class_id","a.subject_id","a.teacher_id","a.is_active","a.created_at","a.updated_at");
        $data = DB::select("u.firstname", "u.lastname","c.name AS class","s.name AS subject");
        $data = DB::from("assign_cs AS a");
        $data = DB::leftJoin("users AS u", "u.id","a.teacher_id");
        $data = DB::leftJoin("classes AS c", "c.id","a.class_id");
        $data = DB::leftJoin("subjects AS s", "s.id","a.subject_id");
        $data = DB::where(["a.id" => self::$id]);
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
            $data = DB::create("assign_cs", [
                "class_id" => self::$class_id,
                "subject_id" => self::$subject_id,
                "teacher_id" => self::$teacher_id,
                "is_active" => self::$is_active,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ])::execute();
    
            if($data){
                msg::set("1 row created successfuly","success");
                http::redirect("assign-cs");
            }
        }
    }

    public static function update(){
        if(self::$action == "update"){
            $data = DB::update("assign_cs", [
                "class_id" => self::$class_id,
                "subject_id" => self::$subject_id,
                "teacher_id" => self::$teacher_id,
                "is_active" => self::$is_active,
                "updated_at" => date('Y-m-d H:i:s')
            ]);
            $data = DB::where(["id" => self::$id]);
            $data = DB::execute();
    
            if($data){
                msg::set("1 row updated successfuly","success");
                http::redirect("assign-cs");
            }
        }
    }

    public static function delete(){
        if(self::$action == "delete"){
            $data = DB::delete("assign_cs");
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
                    <a class="dropdown-item" href="assign-cs-details.php?id='.$id.'">
                        <span class="bx bx-show text-success align-middle"></span> Details 
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="assign-cs-update.php?id='.$id.'">
                        <span class="bx bx-edit text-success align-middle"></span> Update 
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="assign-cs.php?id='.$id.'&action=delete">
                        <span class="bx bx-trash text-danger align-middle"></span> Delete
                    </a>
                </li>
            </ul>
        </div>';
    }

    // Extra functions
    public static function classes(){
        $data = DB::select("id","name");
        $data = DB::from("classes");
        $data = DB::where(["is_active" => true]);
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function subjects(){
        $data = DB::select("id","name");
        $data = DB::from("subjects");
        $data = DB::where(["is_active" => true]);
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function teachers(){
        $data = DB::select("id","firstname","lastname");
        $data = DB::from("users");
        $data = DB::where(["is_role" => 1, "is_active" => true]);
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

}
// Init class for construct values
$module = new module();
?>