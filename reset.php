<?php
require_once('config/database.php');
$flash = array();

if ($_GET['token'] && $_GET['login'])
{
	if (!empty($_GET['token']) && !empty($_GET['login']) && !empty($_POST['password']) && !empty($_POST['repassword']))
	{
		$length = strlen($_POST['password']) >= 8;
		$number = preg_match('#[0-9]#', $_POST['password']);
		if (empty($_POST['password']) || !$length || !$number || $_POST['password'] != $_POST['repassword'])
		{
			$flash['alert'] = "Password invalide";
		}
		if (empty($flash))
		{
			setPassword($db, $_POST['password'], $_GET['login']);
		}
	}
	require('views/view-reset_password.php');
}

if (!empty($_POST) && $_POST['mail'])
{

	if (empty($flash))
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
			//$flash['info'] = "un mail de réinitialisation vous à été envoyer";
			$key = "http://localhost:8080/camagru/reset.php?token={$var['confirmation_token']}&login={$var['username']}";
			sendReset($_POST['mail'], $var['username'], $key);
			$_SESSION['alert'] = "un mail de réinitialisation vient de vous etes envoyé";
		}
	}
	if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
	{
		$_SESSION['alert'] = "utilisateur introuvable";
	}
}
if (!$_GET['token'] && !$_GET['login'])
{
	require('views/view-reset.php');
}
?>