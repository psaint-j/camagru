<?php 
require('config/session.php');
require_once('config/database.php');
if($_POST['comment'] && $_POST['image_id'])
{
	$req = $db->prepare('INSERT INTO comments SET user_id = ?, image_id = ?, text_comment = ?');
	$req->execute(array($_SESSION['id'], $_POST['image_id'], $_POST['comment']));
	echo $_SESSION['username'];
}
?>