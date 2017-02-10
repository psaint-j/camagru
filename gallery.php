<?php
require('config/session.php');
require_once('config/database.php');
if ($_GET['p'])
{

	require('views/view-gallery.php');
}
else
{
	header('Location: index.php');
}
?>