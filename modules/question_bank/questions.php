<?php
class module {
    public static $action;
    private static $id;
    private static $category_id;
    private static $assign_id;
    private static $chapter_id;
    private static $topic_id;
    private static $marks;
    private static $estimated_time;
    private static $statement;
    private static $answer;
    private static $image;
    private static $opt1;
    private static $opt2;
    private static $opt3;
    private static $opt4;
    private static $is_options;
    private static $teacher_id;
    private static $is_active;

    public function __construct(){
        self::$action = http::param("action");
        self::$id = http::param("id");
        self::$category_id = http::param("category_id");
        self::$assign_id = http::param("assign_id");
        self::$chapter_id = http::param("chapter_id");
        self::$topic_id = http::param("topic_id");
        self::$marks = http::param("marks");
        self::$estimated_time = http::param("estimated_time");
        self::$statement = http::param("statement");
        self::$answer = http::param("answer");
        self::$image = http::param("image");
        self::$is_options = http::param("is_options");
        self::$opt1 = http::param("opt1");
        self::$opt2 = http::param("opt2");
        self::$opt3 = http::param("opt3");
        self::$opt4 = http::param("opt4");
        self::$teacher_id = http::param("teacher_id");
        self::$is_active = http::param("is_active");
    }

    public static function listing(){
        $data = DB::select("q.id","q.chapter_id","q.topic_id","q.marks","q.estimated_time","q.statement");
        $data = DB::select("q.is_options","q.is_active","q.created_at","q.updated_at","t.name AS category");
        $data = DB::select("s.name AS subject", "c.name AS class", "u.firstname","u.lastname");
        $data = DB::from("questions AS q");
        $data = DB::leftJoin("users AS u", "u.id","q.created_by");
        $data = DB::leftJoin("categories AS t", "t.id","q.category_id");
        $data = DB::leftJoin("assign_cs AS a", "a.id","q.assign_id");
        $data = DB::leftJoin("subjects AS s", "s.id","a.subject_id");
        $data = DB::leftJoin("classes AS c", "c.id","a.class_id");
        $data = DB::sort("q.id","DESC");
        $data = DB::paging();
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function single(){
        $data = DB::select("q.id","q.category_id","q.assign_id","q.chapter_id","q.topic_id","q.marks","q.estimated_time");
        $data = DB::select("q.statement","q.answer","q.opt1","q.opt2","q.opt3","q.opt4","q.is_options","q.image","q.is_active");
        $data = DB::select("q.created_at","q.updated_at","ca.name AS category","s.name AS subject");
        $data = DB::select("c.name AS class", "t.name AS topic","ch.name AS chapter", "u.firstname","u.lastname");
        $data = DB::from("questions AS q");
        $data = DB::leftJoin("users AS u", "u.id","q.created_by");
        $data = DB::leftJoin("categories AS ca", "ca.id","q.category_id");
        $data = DB::leftJoin("assign_cs AS a", "a.id","q.assign_id");
        $data = DB::leftJoin("subjects AS s", "s.id","a.subject_id");
        $data = DB::leftJoin("classes AS c", "c.id","a.class_id");
        $data = DB::leftJoin("chapters AS ch", "ch.id","q.chapter_id");
        $data = DB::leftJoin("topics AS t", "t.id","q.topic_id");
        $data = DB::where(["q.id" => self::$id]);
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
            $data = DB::create("questions", [
                "category_id" => self::$category_id,
                "assign_id" => self::$assign_id,
                "chapter_id" => self::$chapter_id,
                "topic_id" => self::$topic_id,
                "marks" => self::$marks,
                "estimated_time" => self::$estimated_time,
                "statement" => self::$statement,
                "answer" => self::$answer,
                "image" => self::$image,
                "opt1" => self::$opt1,
                "opt2" => self::$opt2,
                "opt3" => self::$opt3,
                "opt4" => self::$opt4,
                "is_options" => self::$is_options,
                "is_active" => self::$is_active,
                "created_by" => self::$teacher_id,
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ])::execute();
    
            if($data){
                msg::set("1 row created successfuly","success");
                http::redirect("questions");
            }
        }
    }

    public static function update(){
        if(self::$action == "update"){
            $data = DB::update("questions", [
                "category_id" => self::$category_id,
                "assign_id" => self::$assign_id,
                "chapter_id" => self::$chapter_id,
                "topic_id" => self::$topic_id,
                "marks" => self::$marks,
                "estimated_time" => self::$estimated_time,
                "statement" => self::$statement,
                "answer" => self::$answer,
                "image" => self::$image,
                "opt1" => self::$opt1,
                "opt2" => self::$opt2,
                "opt3" => self::$opt3,
                "opt4" => self::$opt4,
                "is_options" => self::$is_options,
                "is_active" => self::$is_active,
                "created_by" => self::$teacher_id,
                "updated_at" => date('Y-m-d H:i:s')
            ]);
            $data = DB::where(["id" => self::$id]);
            $data = DB::execute();
    
            if($data){
                msg::set("1 row updated successfuly","success");
                http::redirect("questions");
            }
        }
    }

    public static function delete(){
        if(self::$action == "delete"){
            $data = DB::delete("questions");
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
                    <a class="dropdown-item" href="question-details.php?id='.$id.'">
                        <span class="bx bx-show text-success align-middle"></span> Details 
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="question-update.php?id='.$id.'">
                        <span class="bx bx-edit text-success align-middle"></span> Update 
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="questions.php?id='.$id.'&action=delete">
                        <span class="bx bx-trash text-danger align-middle"></span> Delete
                    </a>
                </li>
            </ul>
        </div>';
    }

    // Extras
    public static function categories(){
        $data = DB::select("id","name");
        $data = DB::from("categories");
        if(f::is_teacher()){
            $data = DB::where(["created_by" => session::get("id"), "is_active" => true]);
        } else{
            $data = DB::where(["is_active" => true]);
        }
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function assign_cs(){
        $data = DB::select("a.id","c.name AS class","s.name AS subject");
        $data = DB::from("assign_cs AS a");
        $data = DB::leftJoin("subjects AS s", "s.id","a.subject_id");
        $data = DB::leftJoin("classes AS c", "c.id","a.class_id");
        $data = DB::from("assign_cs AS a");       
        if(f::is_teacher()){
            $data = DB::where(["a.teacher_id" => session::get("id"), "a.is_active" => true]); 
        } else {
            $data = DB::where(["a.is_active" => true]);
        }
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function chapters(){
        $assign_id = http::param("assign");
        $data = DB::select("id","name");
        $data = DB::from("chapters");
        if(f::is_teacher()){
            $data = DB::where(["assign_id" => $assign_id, "created_by" => session::get("id"), "is_active" => true]);            
        } else {
            $data = DB::where(["assign_id" => $assign_id, "is_active" => true]);            
        } 
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function topics(){
        $chapter = http::param("chapter");
        $data = DB::select("id","name");
        $data = DB::from("topics");
        if(f::is_teacher()){
            $data = DB::where(["chapter_id" => $chapter, "created_by" => session::get("id"), "is_active" => true]);            
        } else {
            $data = DB::where(["chapter_id" => $chapter, "is_active" => true]);            
        } 
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