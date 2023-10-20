<?php

class module {
    public static $action;
    private static $id;
    private static $name;
    private static $tagline;

    public function __construct(){
        self::$action = http::param("action");
        self::$id = http::param("id");
        self::$name = http::param("name");
        self::$tagline = http::param("tagline");
    }

    public static function single(){
        $data = DB::select("id", "name", "tagline");
        $data = DB::from("settings");
        $data = DB::first();
        $data = DB::execute();
        $data = DB::fetch("one");
        return $data;
    }

    public static function create() {
        if(self::$action == "create"){
            $data = DB::create("settings", [
                "name" => self::$name,
                "tagline" => self::$tagline,
                "created_at" => date("Y-m-d H:i:s"),
                "updated_at" => date("Y-m-d H:i:s")
            ])::execute();
    
            if($data){
                msg::set("Settings updated successfully","success");
                http::redirect("settings");
            }
        }
    }

    public static function update(){
        if(self::$action == "update"){
            $data = DB::update("settings", [
                "name" => self::$name,
                "tagline" => self::$tagline,
                "updated_at" => date("Y-m-d H:i:s")
            ]);
            $data = DB::execute();

            if($data){
                msg::set("Settings updated successfully","success");
                http::redirect("settings");
            }
        }
    }
}

// Init class for construct values
$module = new module();