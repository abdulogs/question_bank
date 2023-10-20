<?php
class module {

    public static $action;
    private static $id;


    public function __construct(){
        self::$action = http::param("action");
        self::$id = http::param("id");
    }

    public static function listing(){
        $data = DB::select("p.id","p.assign_id","p.total_marks","p.total_time","p.questions","p.chapters","p.created_at");
        $data = DB::select("p.updated_at","u.firstname","u.lastname","c.name AS class","s.name AS subject");
        $data = DB::from("papers AS p");
        $data = DB::leftJoin("users AS u", "u.id","p.created_by");
        $data = DB::leftJoin("assign_cs AS a", "a.id","p.assign_id");
        $data = DB::leftJoin("subjects AS s", "s.id","a.subject_id");
        $data = DB::leftJoin("classes AS c", "c.id","a.class_id");
        if(f::is_teacher()){
            $data = DB::where(["p.created_by" => session::get("id")]);
        }
        $data = DB::sort("p.id","DESC");
        $data = DB::paging();
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function single(){
        $data = DB::select("p.id","p.assign_id","p.total_marks","p.total_time","p.questions","p.chapters");
        $data = DB::select("p.categories","c.name AS class","s.name AS subject");
        $data = DB::from("papers AS p");
        $data = DB::leftJoin("assign_cs AS a", "a.id","p.assign_id");
        $data = DB::leftJoin("subjects AS s", "s.id","a.subject_id");
        $data = DB::leftJoin("classes AS c", "c.id","a.class_id");
        if(f::is_teacher()){
            $data = DB::where(["p.id" => self::$id, "p.created_by" => session::get("id")]);
        } else{
            $data = DB::where(["p.id" => self::$id]);
        }
        $data = DB::execute();
        $data = DB::fetch("one");
        if(!$data){
            http::redirect("404");
        } else {
            return $data;
        }
    }

    public static function delete(){
        if(self::$action == "delete"){
            $data = DB::delete("papers");
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
                    <a class="dropdown-item" href="paper-details.php?id='.$id.'">
                        <span class="bx bx-show text-success align-middle"></span> Details 
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="paper-details.php?id='.$id.'&action=doc">
                        <span class="bx bxs-file-doc text-success align-middle"></span> Generate docx
                    </a>
                </li>
                <li>
                    <a class="dropdown-item" href="paper-details.php?id='.$id.'&action=pdf">
                        <span class="bx bxs-file-pdf text-success align-middle"></span> Generate pdf
                    </a>
                </li>
                <li>
                <a class="dropdown-item" href="paper-details.php?id='.$id.'&action=print">
                    <span class="bx bx-printer text-success align-middle"></span> Print 
                </a>
            </li>
                <li>
                    <a class="dropdown-item" href="papers.php?id='.$id.'&action=delete">
                        <span class="bx bx-trash text-danger align-middle"></span> Delete
                    </a>
                </li>
            </ul>
        </div>';
    }

    // Extras
    public static function categories($ids){
        $data = DB::select("*");
        $data = DB::from("categories");
        $data = DB::in("id", $ids);
        $data = DB::sort("ordering","ASC");
        $data = DB::execute();
        $data = DB::fetch("all");
        return $data;
    }

    public static function questions($ids){
        $data = DB::select("*");
        $data = DB::from("questions");
        $data = DB::in("id", $ids);
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