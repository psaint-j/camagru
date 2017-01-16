<?php
if (!empty($_POST))
{
	$error = array();
	if (empty($_POST['username']) || !preg_match('/^[a-z0-9]+$/', $_POST['username']) || strlen($_POST['username']) > 16)
{
	$error['username'] = "vous n'avez pas entrer de pseudo valide (alphanumerique)";
}
if (empty($_POST['mail']) || !filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
{
	$error['mail'] = "Votre email n'est pas valide";
}
if (empty($_POST['password']) || $_POST['password'] != $_POST['repassword'])
{
	$error['password'] = "Vous devez renter un mot de passe valide"; 
}

if (empty($error))
{
	session_start();

	require_once("config/database.php");
	addUser($db, $DB_NAME, $_POST['username'], $_POST['mail'], $_POST['password']);

}
	//var_dump($error);
}
require ('views/view-index.php');
?>