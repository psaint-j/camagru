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
		//$req->prepare("SELECT id WHERE user")
	}
	if (empty($_POST['password']))
	{
		$error['password'] = "Vous devez renter un mot de passe valide"; 
	}
	if (empty($error))
	{

		//require_once('config/database.php');
		//Login($db, $DB_NAME, $_POST['username'], $_POST['password']);
	}
	var_dump($error);
}
require ('views/view-login.php');
?>