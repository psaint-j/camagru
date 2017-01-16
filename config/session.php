<?php 
function sessionStart($post)
{
	$_SESSION['username']= $post['username'];
	$_SESSION['signup']= 1;
}
