<?php
class module {
    public static $action;
    private static $id;
    private static $name;
    private static $chapter_id;
    private static $teacher_id;
    private static $is_active;

    public function __construct(){
        self::$action = http::param("action");
        self::$id = http::param("id");
        self::$name = http::param("name");
        self::$chapter_id = http::param("chapter_id");
        self::$teacher_id = http::param("teacher_id");
        self::$is_active = http::param("is_active");
    }

    public static function listing(){
        $data = DB::select("t.id","t.name AS topic","t.is_active", "t.created_at", "t.updated_at");
        $data = DB::select("u.firstname", "u.lastname","ch.name AS class","s.name AS subject","c.name AS chapter");
        $data = DB::from("topics AS t");
        $data = DB::leftJoin("chapters AS c", "c.id","t.chapter_id");
        $data = DB::leftJoin("assign_cs AS a", "a.id","c.assign_id");
        $data = DB::leftJoin("classes AS ch", "ch.id","a.class_id");
        $data = DB::leftJoin("subjects AS s", "s.id","a.subject_id");
        $data = DB::leftJoin("users AS u", "u.id","t.created_by");
        $data = DB::sort("a.id","DESC");
        $data = DB::paging();
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function single(){
        $data = DB::select("t.id","t.name AS topic","t.is_active", "t.created_by","t.created_at", "t.updated_at");
        $data = DB::select("u.firstname", "u.lastname","ch.name AS class","s.name AS subject","c.name AS chapter");
        $data = DB::select("t.chapter_id");
        $data = DB::from("topics AS t");
        $data = DB::leftJoin("chapters AS c", "c.id","t.chapter_id");
        $data = DB::leftJoin("assign_cs AS a", "a.id","c.assign_id");
        $data = DB::leftJoin("classes AS ch", "ch.id","a.class_id");
        $data = DB::leftJoin("subjects AS s", "s.id","a.subject_id");
        $data = DB::leftJoin("users AS u", "u.id","t.created_by");
        $data = DB::where(["t.id" => self::$id]);
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
            $data = DB::create("topics", [
                "name" => self::$name,
                "chapter_id" => self::$chapter_id,
                "is_active" => self::$is_active,
                "created_by" => self::$teacher_id,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ])::execute();
    
            if($data){
                msg::set("1 row created successfuly","success");
                http::redirect("topics");
            }
        }
    }

    public static function update(){
        if(self::$action == "update"){
            $data = DB::update("topics", [
                "name" => self::$name,
                "chapter_id" => self::$chapter_id,
                "is_active" => self::$is_active,
                "created_by" => self::$teacher_id,
                "updated_at" => date('Y-m-d H:i:s')
            ]);
            $data = DB::where(["id" => self::$id]);
            $data = DB::execute();
    
            if($data){
                msg::set("1 row updated successfuly","success");
                http::redirect("topics");
            }
        }
    }

    public static function delete(){
        if(self::$action == "delete"){
            $data = DB::delete("topics");
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
                    <a class="dropdown-item" href="topic-details.php?id='.$id.'">
                        <span class="bx bx-show text-success align-middle"></span> Details 
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="topic-update.php?id='.$id.'">
                        <span class="bx bx-edit text-success align-middle"></span> Update 
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="topics.php?id='.$id.'&action=delete">
                        <span class="bx bx-trash text-danger align-middle"></span> Delete
                    </a>
                </li>
            </ul>
        </div>';
    }

    // Extra functions
    public static function chapters(){
        $data = DB::select("ch.id","ch.name AS chapter","c.name AS class","s.name AS subject");
        $data = DB::from("chapters AS ch");
        $data = DB::leftJoin("assign_cs AS a", "a.id","ch.assign_id");
        $data = DB::leftJoin("classes AS c", "c.id","a.class_id");
        $data = DB::leftJoin("subjects AS s", "s.id","a.subject_id");
        if(f::is_teacher()){
            $data = DB::where(["ch.created_by" => session::get("id"), "ch.is_active" => true]);
        }
        $data = DB::sort("ch.id","ASC");
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function teachers(){
        $data = DB::select("id","firstname","lastname");
        $data = DB::from("users");
        if(f::is_teacher()){
            $data = DB::where(["is_role" => 1, "id" => session::get("id"), "is_active" => true]);
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