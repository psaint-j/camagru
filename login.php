<?php 
require_once('config/database.php');
require('config/session.php');
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
		$error['username'] = "username invalide !";
	}
	if (empty($_POST['password']))
	{
		$error['password'] = "Vous devez renter un mot de passe valide";
	}
	if (empty($error))
	{
		$req = $db->prepare('SELECT id, confirmation_at FROM users WHERE username = ? AND password = ?');
		$req->execute(array($_POST['username'], password_cryte($_POST['password'])));
		$var = $req->fetch();
		if (is_array($var))
		{
			extract($var);
			if (empty($confirmation_at))
			{
				$error['activation'] = "vous devez activer votre compte";
			}
			if ($confirmation_at && $id != NULL)
			{
				session_init($_POST['username'], $id);
				header('Location: menber.php');
				exit;
			}
		}
		else{
			$error['invalide'] = "username ou mot de passe invalide";
		}
	}
}
require ('views/view-login.php');
?>