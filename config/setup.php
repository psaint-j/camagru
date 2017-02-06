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
	SetupDatabase($db, $DB_NAME);
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

	$db->exec("CREATE TABLE images(
		id INT(10) PRIMARY KEY AUTO_INCREMENT,
		user_id INT(10) NOT NULL,
		link VARCHAR(60) NOT NULL, 
		at DATETIME DEFAULT NULL);");
	$db->exec("CREATE TABLE likes (
		id INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
		user_id INT NOT NULL , 
		image_id INT NOT NULL);");
	$db->exec("CREATE TABLE comments( 
		id INT NOT NULL PRIMARY KEY AUTO_INCREMENT , 
		user_id INT NOT NULL , 
		image_id INT NOT NULL , 
		text_comment VARCHAR(500) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL);");
	$db->exec("USE {$db_name}");
}

?>