<?php
require('config/session.php');
if ($_SESSION['username'])
{
	require('views/view-gallery.php');
}
else
{
	header('Location: index.php');
}
 ?>