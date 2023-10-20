<?php

class module {
    public static function admins(){
        $data = DB::select("COUNT(id) AS admins");
        $data = DB::from("users");
        $data = DB::where(["is_role" =>  0]);
        $data = DB::execute()::fetch("one");
        return $data;
    }
    public static function teachers(){
        $data = DB::select("COUNT(id) AS teachers");
        $data = DB::from("users");
        $data = DB::where(["is_role" =>  1]);
        $data = DB::execute()::fetch("one");
        return $data;
    }
    public static function subjects(){
        $data = DB::select("COUNT(id) AS subjects");
        $data = DB::from("subjects");
        $data = DB::execute()::fetch("one");
        return $data;
    }
    public static function classes(){
        $data = DB::select("COUNT(id) AS classes");
        $data = DB::from("classes");
        $data = DB::execute();
        $data = DB::fetch("one");
        return $data;
    }
    public static function chapters(){
        $data = DB::select("COUNT(id) AS chapters")::from("chapters");
        $data = (f::is_teacher()) ? DB::where(["created_by" => session::get("id")]) : $data;
        $data = DB::execute();
        $data = DB::fetch("one");
        return $data;
    }
    public static function topics(){
        $data = DB::select("COUNT(id) AS topics")::from("topics");
        $data = (f::is_teacher()) ? DB::where(["created_by" => session::get("id")]) : $data;
        $data = DB::execute();
        $data = DB::fetch("one");
        return $data;
    }
    public static function questions(){
        $data = DB::select("COUNT(id) AS questions")::from("questions");
        $data = (f::is_teacher()) ? DB::where(["created_by" => session::get("id")]) : $data;
        $data = DB::execute()::fetch("one");
        return $data;
    }
    public static function papers(){
        $data = DB::select("COUNT(id) AS papers")::from("papers");
        $data = (f::is_teacher()) ? DB::where(["created_by" => session::get("id")]) : $data;
        $data = DB::execute()::fetch("one");
        return $data;
    }

}

// Init class for construct values
$module = new module();
?>