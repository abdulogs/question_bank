<?php
class auth {
    public static function user(){
        if(session::get("id")){
            $data = DB::select("*");
            $data = DB::from("users");
            $data = DB::where(["id" => session::get("id")]);
            $data = DB::execute();
            $data = DB::fetch("one");
        } else {
            $data = false;
        }
        return $data;
    }
}
?>