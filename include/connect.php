<?php
    DEFINE('DB_HOSTNAME', 'localhost');
    DEFINE('DB_DATABASE', 'tasks_project');
    DEFINE('DB_USERNAME', 'root');
    DEFINE('DB_PASSWORD', 'root');

    $HerokuDatabaseUrl = getenv("CLEARDB_DATABASE_URL");

	if($HerokuDatabaseUrl){
		$DbUrl = parse_url($HerokuDatabaseUrl);
		
		//These are your consts for your heroku env
		$DbServer = $DbUrl["host"];
		$DbUser = $DbUrl["user"];
		$DbPassword = $DbUrl["pass"];
		$DbName = substr($DbUrl["path"], 1);
	} else {
		$DbServer = DB_HOSTNAME;
		$DbUser = DB_USERNAME;
		$DbPassword = DB_PASSWORD;
		$DbName = DB_DATABASE;
	}

	$dsn = "mysql:host=$DbServer;dbname=$DbName;charset=utf8";
	$opt = array(
	    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
	    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
	    PDO::ATTR_EMULATE_PREPARES   => false,
	);
	$pdo = new PDO($dsn, $DbUser, $DbPassword, $opt);   	
	
	function dbQuery($query, $values=array()){
	  global $pdo;
	
	  $stmt = $pdo->prepare($query);
	  $stmt->execute($values);
	  return $stmt;
		//To get data out, use ->fetch() for one row or ->fetchAll() for all rows
	}









