<?php 
require('config/session.php');
if ($_SESSION['username'])
{
	require ('views/view-menber.php');
}
else{
	header('Location: index.php');
}
?>