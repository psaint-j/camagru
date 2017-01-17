<?php
require_once("config/database.php");
if (!empty($_POST))
{
	$error = array();
	if (empty($_POST['username']) || !preg_match('/^[a-z0-9]+$/', $_POST['username']) || strlen($_POST['username']) > 16)
{
	$error['username'] = "vous n'avez pas entrer de pseudo valide (alphanumerique)";
}
else
{
	$req = $db->prepare('SELECT id FROM users WHERE username = ?');
	$req->execute([$_POST['username']]);
	$user = $req->fetch();
	if ($user)
	{
		$error['username'] = "Cette username est déjà pris";
	}
}

if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
{
	$error['mail'] = "Votre email n'est pas valide";
}
else
{
	$req = $db->prepare('SELECT id FROM users WHERE email = ?');
	$req->execute([$_POST['mail']]);
	$mail = $req->fetch();
	if ($mail)
	{
		$error['mail'] = "Cette adresse mail est déjà prise";
	}
}

if (empty($_POST['password']) || $_POST['password'] != $_POST['repassword'])
{
	$error['password'] = "Ce mot de passe est invalide"; 
}

if (empty($error))
{
	addUser($db, $_POST['username'], $_POST['mail'], $_POST['password']);
	//sessionStart($_POST);
}
	//var_dump($error);
}
require ('views/view-index.php');
?>