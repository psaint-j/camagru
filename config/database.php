<?php

//session_start();

$DB_DSN = "mysql:host=localhost:8889";
$DB_USER = "root";
$DB_PASSWORD = "root";
$DB_NAME = "42_camagru";

try
{
	$db = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	//SetupDatabase($db, '42_camagru');
	//addUser($db, $DB_NAME, $_POST['username'], $_POST['mail'], $_POST['password']);
}
catch(PDOException $e)
{	
	echo $e->getMessage();
}

function addUser($db, $db_name, $name, $email, $password)
{
	$db->exec("USE {$db_name}");
	$db->exec("INSERT INTO users(name, email, password, active)
		VALUES('${name}', '${email}', '${password}', 0);");
	header('Location:login.php');
}

function Login($db, $db_name, $name, $password)
{
	$check_name = $db->exec("SELECT * FROM users WHERE login='{$name}';");
	if (check_name)
	{
		echo "TRUE";
	}
	else{
		echo "FALSE";
	}
}

function SetupDatabase($db, $db_name)
{
	$db->exec("CREATE DATABASE IF NOT EXISTS {$db_name};");
	$db->exec("USE {$db_name};");
	$db->exec("CREATE TABLE users(
		id INT(10) PRIMARY KEY AUTO_INCREMENT,
		name VARCHAR(10) NOT NULL, 
		email VARCHAR(255) NOT NULL,
		password VARCHAR(255) NOT NULL,
		active INT(1) NOT NULL);");
	header('Location:login.php');
}

function DeletedDatabase($db, $name)
{
	$db->exec("DROP DATABASE IF EXISTS {$name};");
}