<?php
require('config/session.php');
require_once('config/database.php');
if ($_SESSION['username'])
{

	require('views/view-gallery.php');
}
else
{
	header('Location: index.php');
}
?>