<html>
	<header>
		<link rel="stylesheet" type="text/css" href="css/confirmation.css">
		<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Montserrat|Pacifico|Roboto" rel="stylesheet">
	</header>
	<body>
		<div class="box">
		<form action="reset.php" method="POST">
			<h1>Envoyer un mail de réinitialisation</h1>
			<input type="email" placeholder="mail" name="mail" required>
			<button type="submit">Envoyer un mail</button>
			</form>
		</div>
		<?php
		var_dump($_SESSION);
			if ($_POST['mail'] || $_SESSION['alert'])
			{
				print_r('<div class="alert aGreen">');
				echo $_SESSION['alert'];
				print_r('</div>');
			}
		 ?>
	</body>
</html>