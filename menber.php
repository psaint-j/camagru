<?php 
	require('config/session.php');
	if ($_SESSION['username'])
	{
		var_dump($_SESSION);
		echo "<h1>Hello {$_SESSION['username']}</h1>";
	}
	else{
		header('Location: index.php');
	}
?>