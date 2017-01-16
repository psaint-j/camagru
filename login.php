<?php 
if (!empty($_POST))
{
	$error = array();
	if (empty($_POST['username']) || !preg_match('/^[a-z0-9]+$/', $_POST['username']) || strlen($_POST['username']) > 16)
	{
		$error['username'] = "username invalide !";
	}
	if (empty($_POST['password']))
	{
		$error['password'] = "Vous devez renter un mot de passe valide"; 
	}
	if (empty($error))
	{
		require_once('config/database.php');
		Login($db, $DB_NAME, $_POST['username'], $_POST['password']);
	}
}
require ('views/view-login.php');
?>