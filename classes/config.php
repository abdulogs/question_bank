<?php
class config {
	/***  Properties ***/
	private static $debug;
	public static $con;
	private static $timezone;
	protected static $url;
    private static $hostname;
	private static $username;
	private static $password;
	private static $database;
	public static $dbLimit;
	public static $schoolname;
	public static $schooltagline;

    public function __construct() {
		if (self::$debug == true) {
			return error_reporting(0);
		} else if(self::$debug == false) {
			return error_reporting(1);
		}
	}

	/************** Debug **************/
	public static function debug($debug){
		return self::$debug = $debug;
	}

	/********* Setting url ***********/
	public static function setUrl($url){
		return self::$url = $url;
	}

    /********* Getting url *********/
	public static function getUrl(){
		return self::$url;
	}

	/************** Database **************/
	public static function DBHost($local = "", $live = ""){
		if (self::$debug ==  true) {
			return self::$hostname = $live;
		} elseif (self::$debug ==  false) {
			return self::$hostname = $local;
		}
	}

	/*************** Database username *****************/ 
	public static function DBUsername($local = "", $live = ""){
		if (self::$debug ==  true) {
			return self::$username = $live;
		} elseif (self::$debug ==  false) {
			return self::$username = $local;
		}
	}

	/*************** Database password *****************/ 
	public static function DBPassword($local = "", $live = ""){
		if (self::$debug ==  true) {
			return self::$password = $live;
		} elseif (self::$debug ==  false) {
			return self::$password = $local;
		}
	}

	/*************** Database name *****************/ 
	public static function DBName($local = "", $live = ""){
		if (self::$debug ==  true) {
			return self::$database = $live;
		} elseif (self::$debug ==  false) {
			return self::$database = $local;
		}
	}

	/*************** DB listng set *****************/ 
	public static function DBSetLimit($value){
		return self::$dbLimit = $value;
	}

	/******* Database connect **********/ 
	public static function DBConnect(){
		try {
			self::$con = new PDO("mysql:host=".self::$hostname.";dbname=".self::$database, self::$username, self::$password);
		    self::$con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch(PDOException $e) {
		$error = "";
		$error .= "<h3 style='font-size:16px;font-family:arial;margin:2px 0;'>Opps there is a error in your code</h3>";
		$error .= "<p style='font-size:14px;font-family:arial;margin:2px 0;'><b>Code :</b> {$e->getCode()}</p>";
		$error .= "<p style='font-size:14px;font-family:arial;margin:2px 0;'><b>Line number :</b> {$e->getLine()}</p>";
		$error .= "<p style='font-size:14px;font-family:arial;margin:2px 0;'><b>Filename</b> :</b> {$e->getFile()}</p>";
		$error .= "<p style='font-size:14px;font-family:arial;margin:2px 0;'><b>Message</b> :</b> {$e->getMessage()}</p>";
		$error .= "<p style='font-size:14px;font-family:arial;margin:2px 0;'><b>Trace</b> :</b>".$e->getTraceAsString()."</p>";
		$error .= "<hr>";
		echo $error;
		}
	}

	/************** Get timeZone **************/ 
	public static function getTimeZone(){
		return self::$timezone;
	}

	/************** Set timeZone **************/ 
	public static function setTimeZone($value){
		self::$timezone = $value;
		return date_default_timezone_set(self::$timezone);
	}

	/********* Setting School name ***********/
	public static function setSchoolName($name){
		return self::$schoolname = $name;
	}
	
	/********* Setting School tagline ***********/
	public static function setSchoolTagline($name){
		return self::$schooltagline = $name;
	}

	/************** Start session **************/ 
	public static function session($value = false){
		if ($value == true){
			session_start();
		}
	}
}