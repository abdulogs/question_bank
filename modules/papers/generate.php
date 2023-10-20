<?php
class module {
    public static $action;
    public static $assign_id;
    public static $total_marks;
    public static $total_time;
    public static $questions;
    public static $chapters;
    public static $categories;

    public function __construct(){
        self::$action = http::param("action");
        self::$assign_id = http::param("assign_id");
        self::$total_marks = http::param("total_marks");
        self::$total_time = http::param("total_time");
        self::$questions = http::param("questions");
        self::$chapters = http::param("chapter_id");
        self::$categories = http::param("categories");
    }

    public static function create() {
        if(self::$action == "create"){
            $questions = implode(",", self::$questions);
            $chapters = implode(",", self::$chapters);
            $categories = implode(",", self::$categories);
            $data = DB::create("papers", [
                "assign_id" => self::$assign_id,
                "total_marks" => self::$total_marks,
                "total_time" => self::$total_time,
                "chapters" => $chapters,
                "questions" => $questions,
                "categories" => $categories,
                "created_by" => session::get("id"),
                "created_at" => date('Y-m-d H:i:s'),
                "updated_at" => date('Y-m-d H:i:s')
            ])::execute();
    
            if($data){
                msg::set("1 row created successfuly","success");
                http::redirect("papers");
            }
        }
    }


    // Extras
    public static function categories(){
        $data = DB::select("*");
        $data = DB::from("categories");
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function class_subject(){
        $data = DB::select("a.id","c.name AS class","s.name AS subject");
        $data = DB::from("assign_cs AS a");
        $data = DB::leftJoin("subjects AS s", "s.id","a.subject_id");
        $data = DB::leftJoin("classes AS c", "c.id","a.class_id");   
        $data = DB::where(["a.id" => http::param("assign_id")]);
        $data = DB::execute();
        $data = DB::fetch("one");
        return $data;
    }


    public static function assign_cs(){
        $data = DB::select("a.id","c.name AS class","s.name AS subject");
        $data = DB::from("assign_cs AS a");
        $data = DB::leftJoin("subjects AS s", "s.id","a.subject_id");
        $data = DB::leftJoin("classes AS c", "c.id","a.class_id");
        $data = DB::from("assign_cs AS a");       
        if(f::is_teacher()){
            $data = DB::where(["a.teacher_id" => session::get("id")]); 
        }
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function chapters(){
        $assign_id = http::param("assign");

        if($assign_id){
            $data = DB::select("id","name");
            $data = DB::from("chapters");
            if(f::is_teacher()){
                $data = DB::where(["assign_id" =>  $assign_id, "created_by" => session::get("id")]);            
            } else {
                $data = DB::where(["assign_id" => $assign_id]);            
            } 
            $data = DB::execute();
            $data = DB::fetch("all");
        } else {
            $data = [];
        }
   
        return $data;
    }

    public static function topics(){
        $chapters = http::param("chapter");

        $data = DB::select("t.id","t.name","c.name AS chapter");
        $data = DB::from("topics AS t");
        $data = DB::leftJoin("chapters AS c", "c.id","t.chapter_id");   
        if(f::is_teacher()){
            $data = DB::where(["t.created_by" => session::get("id")]);            
        } else {
            $data = DB::in("c.name", $chapters);            
        } 
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function questions($id, $limit){
        // Url params
        $assign_id = http::param("assign_id");
        $chapters = http::param("chapter_id");
        $topics = http::param("topic_id");
        // Fetching
        $data = DB::select("q.id", "q.category_id", "q.assign_id", "q.chapter_id", "q.topic_id");
        $data = DB::select("q.marks", "q.estimated_time", "q.statement", "q.is_options","q.opt1","q.opt2");
        $data = DB::select("q.opt3","q.opt4","q.image");
        $data = DB::distinct();
        $data = DB::from("questions AS q");
        $data = DB::leftJoin("chapters AS c", "c.id","q.chapter_id");   
        $data = DB::where(["q.category_id" => $id, "q.assign_id" => $assign_id]);
        $data = DB::in("c.name", $chapters, "AND");  
        $data = DB::in("q.topic_id", $topics, "AND");  
        $data = DB::sort("RAND()");
        $data = DB::limit($limit);
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function settings(){
        $data = DB::select("id", "name", "tagline");
        $data = DB::from("settings");
        $data = DB::first();
        $data = DB::execute();
        $data = DB::fetch("one");
        return $data;
    }
}



// Init class for construct values
$module = new module();
?>