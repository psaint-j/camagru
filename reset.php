<?php
require_once('config/database.php');
$flash = NULL;

if ($_GET['token'] && $_GET['login'])
{
	if (!empty($_GET['token']) && !empty($_GET['login']) && !empty($_POST['password']) && !empty($_POST['repassword']))
	{
		if (!empty($_POST['password']) && ($_POST['password'] != $_POST['repassword']))
		{
			setPassword($db, $_POST['password'], $_GET['login']);
		}
		else
		{

		}
	}
	require('views/view-reset_password.php');
}

if (!empty($_POST) && $_POST['mail'])
{
	$error = array();
	if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
	{
		$flash = "utilisateur introuvable";
	}
	if (empty($error))
	{
		/* recuperation d'information
		 de l'utilisateur */
		$mail = $_POST['mail'];
		$req = $db->prepare('SELECT id, confirmation_token, username FROM users WHERE email = ?');
		$req->execute(array($mail));
		$var = $req->fetch();
		/* update confirmation_at a null*/
		if ($var['id'])
		{
			$req2 = $db->prepare('UPDATE users SET confirmation_at = ? WHERE id = ?');
			$req2->execute(array(null, $var['id']));
			$flash = "un mail de réinitialisation vous à été envoyer";
			$key = "http://localhost:8080/camagru/reset.php?token={$var['confirmation_token']}&login={$var['username']}";
			$test = sendReset($_POST['mail'], $var['username'], $key);
			//echo "<script>console.log($test);</script>";	
		}
	}
	if ($flash)
	{
		//echo $flash;
	}
}
if (!$_GET['token'] && !$_GET['lxogin'])
{
	require('views/view-reset.php');
}
 ?>
