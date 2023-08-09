<?php
    DEFINE('DB_HOSTNAME', 'localhost');
    DEFINE('DB_DATABASE', 'tasks_project');
    DEFINE('DB_USERNAME', 'root');
    DEFINE('DB_PASSWORD', 'root');

    $PLANETSCALEDB = getenv("PLANETSCALEDB");

	if($PLANETSCALEDB){		
		//These are your consts for your heroku env
		$DbServer = getenv("DB_HOST");
		$DbUser = getenv("DB_USER");
		$DbPassword = getenv("DB_PASS");
		$DbName = getenv("DB_NAME");
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
			PDO::MYSQL_ATTR_SSL_CA => "/etc/ssl/certs/ca-certificates.crt",
	);
	$pdo = new PDO($dsn, $DbUser, $DbPassword, $opt);   	
	
	function dbQuery($query, $values=array()){
	  global $pdo;
	
	  $stmt = $pdo->prepare($query);
	  $stmt->execute($values);
	  return $stmt;
		//To get data out, use ->fetch() for one row or ->fetchAll() for all rows
	}









