<?php 
if (!empty($_POST))
{
	require_once('config/database.php');
	$error = array();
	if (empty($_POST['username']) || !preg_match('/^[a-z0-9]+$/', $_POST['username']) || strlen($_POST['username']) > 16)
	{
		$error['username'] = "username invalide !";
	}
	else{
		$req = $db->prepare('SELECT id FROM users WHERE username = ?');
		$req->execute(array($_POST['username']));
		$user = $req->fetch();
		var_dump($user);
	}
	if (empty($_POST['password']))
	{
		$error['password'] = "Vous devez renter un mot de passe valide";
	}
	else{
		$req = $db->prepare("SELECT username FROM users WHERE password = ?");
		$pwd = password_cryte($_POST['password']);
		$req->execute(array($pwd));
		$pass = $req->fetch();
		var_dump($pass);
	}
	if (empty($error))
	{
		$req = $db->prepare('SELECT confirmation_at FROM users WHERE username = ?');
		$req->execute(array($pass['username']));
		$var = $req->fetch();
		var_dump($var);
		if ($pass['username'] == $_POST['username'] && !empty($user))
		{
			if (!empty($var['confirmation_at']))
			{
				die('connexion reussie !');
			}
			else{
				die('Vous devez activer votre compte !');
			}
		}
		else
		{
			die('Echec de connexion !');
		}
	}
	var_dump($error);
}
require ('views/view-login.php');
?>