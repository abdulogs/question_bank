<?php
/* Database class */
class DB extends config {

	/*** Properties ***/
	private static $params = [];
	private static $query = "";
	private static $table = "";
	private static $columns = "";
	private static $type = "";
	private static $distinct = "";
	private static $order = "";
	private static $condition = "";
	private static $operator = "";
	private static $joins = "";
	private static $limit = "";
	private static $other = "";
	private static $page = 1;

	/*** Add space before or after the string utility ***/
	public static function space($value){
		$data = " ".$value." ";
		return $data;
	}

	/*** Is null utility ***/
	public static function is_null($condition, $value){
		$data = ($condition) ? $value : "";
		return $data;
	}

	/*** Columns ***/
	public static function select(...$columns){
		// Assigning "select" to the query type variable
		self::$type = "select";
	
		// Check if columns is not a empty string then put comma before the start of the string
		$_columns = (!empty(self::$columns)) ? ", " : " ";
		// Get all the columns
		foreach ($columns as $column) {
			$_columns .= $column.", ";
		}
		// Remove last comma from the string
		$_columns = substr($_columns, 0, -2);
		self::$columns .= $_columns;
		return __CLASS__;

	}
	
	/*** Table ***/
	public static function from($table){
		// Assigning the table name for later use
		self::$table = self::space($table);
		return __CLASS__;
	}
	
	/*** Distinct ***/
	public static function distinct(){
		// Assigning the distinct value true for later use
		self::$distinct = " DISTINCT ";
		return __CLASS__;
	}
	
	
	/*** Order by ***/
	public static function sort($column, $type = ""){
		// Check if order string is not a empty string then put comma before the start of the string
		self::$order .= (!empty(self::$order)) ? ", " : " ";
		// For example id DESC, id ASC
		self::$order .= "{$column} {$type}";
		return __CLASS__;
	}


	/*** Inner Join ***/
	public static function innerJoin($table, $column1, $column2){
		self::$joins .= " INNER JOIN {$table} ON {$column1} = $column2 ";
		return __CLASS__;
	}


	/*** LEFT Join ***/
	public static function leftJoin($table, $column1, $column2){
		self::$joins .= " LEFT JOIN {$table} ON {$column1} = $column2 ";
		return __CLASS__;
	}


	/*** Right Join ***/
	public static function rightJoin($table, $column1, $column2){
		self::$joins .= " RIGHT JOIN {$table} ON {$column1} = $column2 ";
		return __CLASS__;
	}


	/*** Limit ***/
	public static function limit($limit){
		self::$limit = " LIMIT ".$limit;
		return __CLASS__;
	}


	/*** Paging ***/
	public static function paging($page = "", $limit = ""){
		$limit = (empty($limit)) ? parent::$dbLimit : $limit;
		$page = (isset($_GET["page"])) ? $_GET["page"] : 1;
		self::$page = $page;
		$offset = ($page - 1) * $limit;
		$limit = " LIMIT {$offset} , {$limit} ";
		self::$limit = $limit;
		return __CLASS__;
	}
	
	// Next or previous btns
	public static function btns($url, $arr){
		$page = (self::$page == 0) ? 1 : self::$page; 

		if($page > 1) {
			echo '<a href="'.$url.'.php?page='.$page - '1'.'" class="btn btn-dark border">Back</a>';
		} else {
            echo '<button class="btn btn-dark border" disabled>Back</button>';
		}

		if(count($arr) ==  self::$dbLimit){
			echo '<a href="'.$url.'.php?page='.$page + '1'.'" class="btn btn-dark border">Next</a>';
		} else {
            echo '<button class="btn btn-dark border" disabled>Next</button>';
		}
	}

	/*** Create ***/
	public static function create($table, $columns){
		// Assigning "create" to the query type variable
		self::$type = "create";

		// Assigning the table name for later use
		self::$table = self::space($table);

		// Getting all the column values by merging two arrays
		self::$params = array_merge($columns, self::$params);

		// Getting all the column names and separating them with commas
		self::$columns .= "(" . implode(", " , array_keys($columns)) . ")";

		self::$columns .= " VALUES (";

		// Getting all the values of the columns and letting them to be a ? for prepare statement
		for ($i = 0; $i < count($columns); ++$i) {
			self::$columns .= "?, ";
		}
		// Removing last comma from the string after ? 
		self::$columns = substr(self::$columns, 0, -2);

		self::$columns .= ")";
		return __CLASS__;
	}

	/*** Update ***/
	public static function update($table ,$columns) {
		// Assigning "update" to the query type variable
		self::$type = "update";

		// Assigning the table name for later use
		self::$table = self::space($table);

		// Getting all the column values by merging two arrays
		self::$params = array_merge($columns, self::$params);

		// Getting all the values of the columns and letting them to be a ? for prepare statement
		for ($i = 0; $i < count($columns); ++$i) {
			self::$columns  .= array_keys($columns)[$i] . " = ?, ";
		}

		// Removing last comma from the string after ? 
		self::$columns = substr(self::$columns, 0, -2);

		return __CLASS__;
	}

	/*** Delete ***/
	public static function delete($table){
		// Assigning "delete" to the query type variable
		self::$type = "delete";
		// Assigning the table name for later use
		self::$table = self::space($table);
		return __CLASS__;
	}

	/*** First record ***/
	public static function first($column = "id"){
		return self::$other = "ORDER BY {$column} ASC LIMIT 1";
	}

	/*** Last record ***/
	public static function last($column = "id"){
		return self::$other = "ORDER BY {$column} DESC LIMIT 1";
	}

	/*** Where ***/
	public static function where($condition, $operator="AND"){

		$condition = array_filter($condition, fn($value) => !is_null($value) && $value !== '');

		if(!empty($condition)){
			// Getting all the column values by merging two arrays
			self::$params = array_merge(self::$params, $condition);

			self::$condition .= "(";

			// Getting all the values of the columns and letting them to be a ? for prepare statement
			foreach($condition as $key => $value){
				// if(!empty($value)){
					self::$condition .= $key . "= ? ".$operator." ";
				// }
			}

			// Removing last operator from the string after ? 
			self::$condition = substr(self::$condition, 0,  -strlen($operator) - 1 ).")";
		}
		return __CLASS__;
	}

	/*** In ***/
	public static function in($col, $condition, $operator = ""){
		// Convert string to array after spiliting comma to index
		if(!is_array($condition)){
			$condition = explode(",", $condition);
		} else {
			$condition = $condition;
		}

		// Getting all the column values by merging two arrays
		self::$params = array_merge(self::$params, $condition);

		self::$condition .= self::space($operator);
		self::$condition .= self::space($col." IN");
		self::$condition .= "(";

		// Getting all the values of the columns and letting them to be a ? for prepare statement
		foreach($condition as $option){
			self::$condition .= "?,";
		}

		self::$condition = substr(self::$condition, 0, -1);
		self::$condition .= ") ";

		return __CLASS__;
	}

	/*** Search ***/
	public static function search($condition, $operator="AND"){
		// Getting all the column values by merging two arrays
		self::$params = array_merge(self::$params, $condition);

		self::$condition .= "(";

		// Getting all the values of the columns and letting them to be a ? for prepare statement
		for ($i = 0; $i < count($condition); ++$i) {
			self::$condition .= array_keys($condition)[$i] . " LIKE '%' ? '%' ".$operator." ";
		}

		// Removing last operator from the string after ? 
		self::$condition = substr(self::$condition, 0,  -strlen($operator) - 1 )." ) ";
		return __CLASS__;
	}

	/*** Between ***/
	public static function between($col, $condition, $operator = ""){
		// self::$params = array_merge(self::$params, array_values($condition));
		// $between = " " . $operator . " " . $col . " BETWEEN ";
		// for ($i = 0; $i < count($condition); ++$i) {
		// 	$between .= " ? AND";
		// }
		// $between = substr($between, 0, -4);
		// self::$query .= $between;
		// return __CLASS__;
	}

	/*** Execute ***/
	public static function execute($exec = ""){
		$query = "";
		// Making a query string
		if(self::$type == "select"){	
			$query .= self::space("SELECT");
			$query .= self::$distinct;
			$query .= self::$columns;
			$query .= self::space("FROM");
			$query .= self::$table;
			$query .= self::$joins;
			$query .= self::is_null(self::$condition, " WHERE ");
			$query .= self::$condition;
			$query .= self::is_null(self::$order, " ORDER BY ");
			$query .= self::$order;
			$query .= self::$limit;
			$query .= self::$other;
		} else if(self::$type == "create"){
			$query .= self::space("INSERT INTO");
			$query .= self::$table;
			$query .= self::$columns;
		} else if(self::$type == "update"){
			$query .= self::space("UPDATE");
			$query .= self::$table;
			$query .= self::space("SET");
			$query .= self::$columns;
			$query .= self::is_null(self::$condition, " WHERE ");
			$query .= self::$condition;
		} else if(self::$type == "delete"){
			$query .= self::space("DELETE FROM");
			$query .= self::$table;
			$query .= self::is_null(self::$condition, " WHERE ");
			$query .= self::$condition;
		}

		self::$query = $query;

		// Spliting the assoc array and getting all the values
		$params = urldecode(http_build_query(self::$params, ' ', '<br><br>'));

		// Display the query 
		if($exec == "query"){	
			$template = "<div style='font-size:14px;font-family:arial;position:fixed;left:20%;right:20%;top:20%;z-inded:999;background:#222;color:white;border-radius:15px;padding:20px;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;'>";
			$template .= "<h1 style='color:orange;'>SQL QUERY</h1>";
			$template .= "<p style='font-size:14px;'><q>".self::$query."</q></p>";
			if(count(array_values(self::$params)) !== 0){
				$template .= "<h3 style='color:yellow;'>Binding params</h3>";
				$template .= "<p style='background:#fff;color:#000;border-radius:5px;padding:10px;'>".$params."</p>";
			}
			$template .= "</div>";
			echo $template;
		} 

		// Execute the query 
		try {
			// Preparing the sql query 
			$result = parent::$con->prepare(self::$query);
			$result->execute(array_values(self::$params));

			// Reseting all the values
			self::$table = "";
			self::$distinct = "";
			self::$columns = "";
			self::$joins = "";
			self::$condition = "";
			self::$operator = "";
			self::$order = "";
			self::$limit = "";
			self::$other = "";
			array_splice(self::$params, 0);

			// Returning the main result after execution
			self::$query = $result;

		} catch (Exception $e) {
			$template = "<div style='font-size:14px;font-family:arial;position:fixed;left:20%;right:20%;top:20%;z-inded:9999;background:#222;color:white;border-radius:15px;padding:20px;box-shadow: rgba(149, 157, 165, 0.2) 0px 8px 24px;'>";
			$template .= "<h1 style='color:red;font-family:arial;margin:10px 0;'>Query error occured</h1>";
			$template .= "<p><b>Line number :</b> {$e->getLine()}</p>";
			$template .= "<p><b>Filename</b> :</b> {$e->getFile()}</p>";
			$template .= "<p><b>Message</b> :</b> {$e->getMessage()}</p>";
			$template .= "<hr>";
			$template .= "<h3 style='color:orange;'>SQL QUERY</h3>";
			$template .= "<p style='font-size:14px;'><q>".self::$query."</q></p>";
			if(count(array_values(self::$params)) !== 0){
				$template .= "<h3 style='color:yellow;'>Binding params</h3>";
				$template .= "<p style='background:#fff;color:#000;border-radius:5px;padding:10px;'>".$params."</p>";
			}
			$template .= "</div>";
			echo $template;
		}
	
		if(self::$type == "select"){
			return __CLASS__;
		} else {
			return true;
		}
	}

	/*** Fetch ***/
	public static function fetch($type = "all"){
		try {
			 $result = self::$query->setFetchMode(PDO::FETCH_ASSOC);

			if ($type == "all") {
				$result = self::$query->fetchall();
			}
			if ($type == "one") {
				$result = self::$query->fetch();
			}
			return $result;
		} catch (Error $e) {
			return "Can't fetch records";
		}
	}

	/*** Last Id ***/
	public static function lastid(){
		$lastid = parent::$con->lastInsertId();
		return $lastid;
	}

	/*** Connection End ***/
	function __destruct(){
		$this->con = NULL;
		if ($this->con == null) {
			return true;
		}
	}
}
