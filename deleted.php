<?php 
require('config/session.php');
require_once('config/database.php');
if($_POST['image_id'])
{
	$req = $db->prepare('DELETE FROM images WHERE user_id = ? AND id = ?');
	$req->execute(array($_SESSION['id'], $_POST['image_id']));
	var_dump($_SESSION);
	var_dump($_POST);
}
?>