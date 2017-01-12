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
     echo "<h1>DONE<h1>";
     SetupDatabase($db);
}
catch(PDOException $e)
{	
     echo $e->getMessage();
}

function SetupDatabase($db)
{
	$db->exec("CREATE DATABASE IF NOT EXISTS lol;");
	$db->exec("USE lol;");
	echo "<h1>DONE<h1>";
}