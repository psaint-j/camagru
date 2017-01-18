<?php
if (!empty($_GET)){
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
			//$req = $db->prepare('UPDATE users SET confirmation_at = ? WHERE username = ?');
			$date = date("Y-m-d");
			echo $date;
			//$req->exec(array($name, $date));
			$db->exec("UPDATE users SET confirmation_at = '{$date}' WHERE username = '{$name}' ");
			die("compte activer avec succes !");
		}
		else
			header('Location:index.php');
	}
	else
	{
		die("ERROR 404");	
	}
}

?>