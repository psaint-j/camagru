<?php
require('config/session.php');
require_once('config/database.php');

if ($_POST['img'] && $_POST['sticker'])
{
	$img = $_POST['img']; // Your data 'data:image/png;base64,AAAFBfj42Pj4';
	$sticker = $_POST['sticker'];
	$img = str_replace('data:image/png;base64,', '', $img);
	$img = str_replace(' ', '+', $img);
	$data = base64_decode($img);
	$today = date("Y-m-d@H:i:s");
	$link = "./tmp/"."{$_SESSION['username']}"."@"."{$today}".".png";// ./tmp/lipfy@2017-01-31-AT-10:55:56
	file_put_contents($link, $data);
	 // user_id = $_SESSION['id'], link = link, at = date
	

	$source = imagecreatefrompng($sticker);
	$largeur_source = imagesx($source);
	$hauteur_source = imagesy($source);
	imagealphablending($source, true);
	imagesavealpha($source, true);

	if ($destination = imagecreatefrompng($link))
	{
	$largeur_destination = imagesx($destination);
	$hauteur_destination = imagesy($destination);

	$destination_x = ($largeur_destination - $largeur_source) / 2;
	$destination_y = ($hauteur_destination - $hauteur_source) / 2;

	imagecopy($destination, $source, $destination_x, $destination_y, 0, 0, $largeur_source, $hauteur_source);
	imagepng($destination, $link);
	imagedestroy($destination);
	imagedestroy($source);
	addImage($db, $_SESSION[id], $link);
	}
}
?>
