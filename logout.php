<?php 	
require('config/session.php');
if ($_SESSION['username'])
{
	$_SESSION['username'] = "";
	$_SESSION['id'] = "";
	header('Location: index.php');
}
?>