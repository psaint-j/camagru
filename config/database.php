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
	$db->exec("USE 42_camagru");
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
		<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Amatic+SC|Cantarell" rel="stylesheet">
	</head>
	<body>
		<h1 style="font-family:Amatic SC;">Hello '.$name.' !</h1>
		<p style="font-family:cantarell;">Afin de confirmer votre enregistrement, veuillez cliquer sur le lien suivant: <a href='.$token.'>activer mon compte</a></p>
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

function sendEmailComment($name, $email, $user)
{ 
// Mail
	$objet = 'Activation de votre compte Camagru' ;
	$contenu = '
	<html>
	<head>
		<title>Activation Camagru</title>
		<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Amatic+SC|Cantarell" rel="stylesheet">
	</head>
	<body>
		<h1 style="font-family:Amatic SC;">Hello '.$name.' !</h1>
		<p">'.$user.' vient de commenter votre photo</p>
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
	exit;
}

function addImage($db, $id, $link)
{
	$today = date("Y-m-d H:i:s");
	$req = $db->prepare("INSERT INTO images SET user_id = ?, link = ?, at = ?");
	$req->execute(array($id, $link, $today));
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

function getComments($db, $image_id)
{
	$req = $db->prepare('SELECT user_id, text_comment FROM comments WHERE image_id = ? ORDER BY id DESC');
	$req->execute(array($image_id));
	$var = $req->fetchAll(PDO::FETCH_CLASS);
	if ($var)
	{
		foreach ($var as $key => $value) {
			$user = findUser($db, $value->user_id);
			$user = htmlentities($user);
			$comment =htmlentities($value->text_comment);
			echo "<h4 class='com_user'>{$user}</h4><p class='com_text'> {$comment}</p>";
			echo "<br>";
		}
	}
}

function getUserImage($db, $id)
{
	$req = $db->prepare('SELECT link, id FROM images WHERE user_id = ? ORDER BY id DESC');
	$req->execute(array($id));
	$var = $req->fetchAll();

	foreach ($var as $key => $value) {
		echo "<img id='{$value['id']}' class='img_data' src='{$value['link']}' onclick='deletedImg(this.id)'>";
	}
	echo "<p style='font-family:Amatic sc;font-size:30px;'>cliquer sur l'image pour la suprimer</p>";
	// var_dump($var);
}

function ifUserImage($db, $id)
{
	$req = $db->prepare('SELECT link FROM images WHERE user_id = ?');
	$req->execute(array($id));
	$var = $req->fetch();
	if ($var['link'])
	{
		return true;
	}
	else
	{
		return false;
	}
}


function findUser($db, $id)
{
	$req = $db->prepare('SELECT username FROM users WHERE id = ?');
	$req->execute(array($id));
	$user = $req->fetch();
	return $user['username'];
}

function CountLike($db, $image_id)
{
	$req = $db->prepare('SELECT COUNT(*) FROM likes WHERE image_id = ?');
	$req->execute(array($image_id));
	$var = $req->fetch();
	echo $var['COUNT(*)'];
}

function DeletedDatabase($db, $name)
{
	$db->exec("DROP DATABASE {$name};");
}

