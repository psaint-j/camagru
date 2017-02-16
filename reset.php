<?php
require_once('config/database.php');
$flash = NULL;
if (!empty($_POST))
{
	$error = array();
	if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
	{
		$flash = "<h2 class='alert aRed'>utilisateur introuvable</h2>";
	}
	if (empty($error))
	{
		/* recuperation d'information
		 de l'utilisateur */
		$mail = $_POST['mail'];
		$req = $db->prepare('SELECT id FROM users WHERE email = ?');
		$req->execute(array($mail));
		$var = $req->fetch();
		/* update confirmation_at a null*/
		if ($var['id'])
		{
			$req2 = $db->prepare('UPDATE users SET confirmation_at = ? WHERE id = ?');
			$req2->execute(array(null, $var['id']));
			$flash = "<h2 class='alert aGreen'>un mail de réinitialisation vous à été envoyer</h2>";
		}
	}
	if ($flash)
	{
		echo $flash;
	}
}
require('views/view-reset.php');
 ?>
