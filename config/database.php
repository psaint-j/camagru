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
	$db->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_NAMED);
	$db->exec("USE 42_camagru");
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

function sendEmail($name, $email, $token)
{ 
// Mail
$objet = 'Activation de votre compte Camagru' ;
$contenu = '
<html>
<head>
   <title>Vous avez réservé sur notre site ...</title>
</head>
<body>
   <h1>Hello '.$name.' !</h1>
   <p>Afin de confirmer votre enregistrement, veuillez cliquer sur le lien suivant: <a href='.$token.'>activer mon compte</a></p>
</body>
</html>';
$entetes =
'Content-type: text/html; charset=utf-8' . "\r\n" .
'From: Camagru@domain.tld' . "\r\n" .
'Reply-To: Camagru@domain.tld' . "\r\n" .
'X-Mailer: PHP/' . phpversion();
                         
//Envoi du mail
mail($email, $objet, $contenu, $entetes);
}

function addUser($db, $name, $email, $password)
{

	$req = $db->prepare("INSERT INTO users SET username = ?, password = ?, email = ?, confirmation_token = ?");
	$token = md5($username + $email + "sevran");
	$password = password_cryte($password);
	$req->execute(array($name, $password, $email, $token));
	$var = md5("true");
	$key = "http://localhost:8080/camagru/confirmation.php?token={$token}&name={$name}";
	sendEmail($name, $email, $key);
	header('Location:login.php?account='."{$var}");
}

function session_init($name, $id)
{
	$_SESSION['username'] = $name;
	$_SESSION['id'] = $id;

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
		confirmation_token VARCHAR(60) NOT NULL,
		confirmation_at DATE DEFAULT NULL);");
	$db->exec("USE {$db_name}");
	//header('Location:login.php');
}

function DeletedDatabase($db, $name)
{
	$db->exec("DROP DATABASE {$name};");
}

