<?php
if (!empty($_GET))
{
	require_once('config/database.php'); 
	extract($_GET);
	$req = $db->prepare('SELECT confirmation_token FROM users WHERE username	 = ?');
	$req->execute(array($name));
	$key = $req->fetch();
	if ($key)
	{
		extract($key);
		if($confirmation_token == $token)
		{
			$date = date("Y-m-d");
			$db->exec("UPDATE users SET confirmation_at = '{$date}' WHERE username = '{$name}' ");
			$status = ("compte activer avec succes !");
		}
		else
			header('Location:index.php');
	}
	else
	{
		$status = ("un probleme est survenue au moment de l'activation du compte");	
	}
}
require_once('views/view-confirmation.php');
?>