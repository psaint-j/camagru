<?php

$DB_DSN = "mysql:host=localhost";
$DB_USER = "root";
$DB_PASSWORD = "root";
$DB_NAME = "42_camagru";

try
{
	$db = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NAMED);
	SetupDatabase($db, '42_camagru');
}
catch(PDOException $e)
{	
	echo $e->getMessage();
}

function SetupDatabase($db, $db_name)
{
	$db->exec("CREATE DATABASE IF NOT EXISTS {$db_name};");
	$db->exec("USE {$db_name};");
	$db->exec("CREATE TABLE users(
		id INT(10) PRIMARY KEY AUTO_INCREMENT,
		username VARCHAR(10) NOT NULL, 
		email VARCHAR(255) NOT NULL,
		password VARCHAR(255) NOT NULL,
		confirmation_token VARCHAR(60) NOT NULL,
		confirmation_at DATE DEFAULT NULL);");
	$db->exec("USE {$db_name}");
}

?>