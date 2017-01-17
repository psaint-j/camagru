<?php
if (!empty($_GET)){
	require_once('config/database.php'); 
	extract($_GET);

	$req = $db->prepare('SELECT confirmation_token FROM users WHERE username = ?');
	$req->execute(array($name));
	$key = $req->fetch();
	extract($key);
	echo "<h1>$confirmation_token</h1>";
}

?>