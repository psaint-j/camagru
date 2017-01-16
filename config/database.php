<?php

//session_start();

$DB_DSN = "mysql:host=localhost";
$DB_USER = "root";
$DB_PASSWORD = "root";
$DB_NAME = "42_camagru";

try
{
	$db = new PDO($DB_DSN,$DB_USER,$DB_PASSWORD);
	$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
	//DeletedDatabase($db, '42_camagru')
	//SetupDatabase($db, '42_camagru');
}
catch(PDOException $e)
{	
	echo $e->getMessage();
}

function password_cryte($password)
{
	$password = md5($password."4343");
	return $password;
}

function addUser($db, $name, $email, $password)
{
	$db->exec("USE 42_camagru");
	$req = $db->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, active = ?");
	$password = password_cryte($password);
	$req->execute(array($name, $password, $email, 0));
	header('Location:login.php');
	die("Votre compte à bien était crée");
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
		username VARCHAR(10) NOT NULL, 
		email VARCHAR(255) NOT NULL,
		password VARCHAR(255) NOT NULL,
		active INT(1) NOT NULL);");
	$db->exec("USE {$db_name}");
	//header('Location:login.php');
}

function DeletedDatabase($db, $name)
{
	$db->exec("DROP DATABASE {$name};");
}

