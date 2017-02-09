<?php 
require('config/session.php');
require_once('config/database.php');
if($_POST['comment'] && $_POST['image_id'])
{
	$req = $db->prepare('INSERT INTO comments SET user_id = ?, image_id = ?, text_comment = ?');
	$req->execute(array($_SESSION['id'], $_POST['image_id'], $_POST['comment']));

	$req = $db->prepare('SELECT user_id FROM images WHERE id = ?');
	$req->execute(array($_POST['image_id']));
	$var = $req->fetch();
	echo $var['user_id'];
	if ($_SESSION['id'] != $var['user_id'])
	{
		$req = $db->prepare('SELECT username, email FROM users WHERE id = ?');
		$req->execute(array($var['user_id']));
		$ui = $req->fetchAll(PDO::FETCH_CLASS);
		echo $ui['email'];
		sendEmailComment($ui->username, $ui->email, $_SESSION['username']);
	}
	else
	{
		echo "this is picture";
	}
}
?>