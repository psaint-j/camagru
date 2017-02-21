<?php
require_once("config/session.php");
require_once("config/database.php");
if ($_SESSION['username'])
{
	header('Location: menber.php');
	exit;
}
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

	$length = strlen($_POST['password']) >= 8;
	$number = preg_match('#[0-9]#', $_POST['password']);
	if (empty($_POST['password']) || !$length || !$number || $_POST['password'] != $_POST['repassword'])
	{
		$error['password'] = "Ce mot de passe est invalide"; 
	}

	if (empty($error))
	{
		addUser($db, htmlentities($_POST['username']), htmlentities($_POST['mail']), htmlentities($_POST['password']));
	}
}
require ('views/view-index.php');
?>