
<?php function roll_safe($message){
echo '<div class="error box">
	<img class="roll_safe" src="img/roll-safe.jpeg" alt="roll safe">
	<p class="message">'.$message.'</p>
<div>';
echo "<style>
	.message{
	font-family: amatic sc;
    font-size: 2em;
    background-color: black;
    color: white;
	}
	.roll_safe{
		width: 100%;
	}
	.box_pagination{
		display: none;
	}
</style>";
}

?>
