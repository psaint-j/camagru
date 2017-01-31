<?php
require('config/session.php');
require_once('config/database.php');
//	var_dump($_SESSION);
if ($_POST['img'])
{
	$img = $_POST['img']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$today = date("Y-m-d@H:i:s");
	$link = "./tmp/"."{$_SESSION['username']}"."@"."{$today}".".png";
	file_put_contents($link, $data);
	// user_id = $_SESSION['id'], link = link, at = date
	addImage($db, $_SESSION[id], $link);
	// ./tmp/lipfy@2017-01-31-AT-10:55:56
}
?>
