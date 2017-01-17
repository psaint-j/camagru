<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Montserrat|Pacifico|Roboto" rel="stylesheet">
	<title>Camagru - login</title>
</head>
<body>
	<h1>Camagru</h1>
	<div class="box">
		<table>
			<form action="login.php" method="POST">
			<?php if ($_GET['account'] == md5("true")): ?>
			<div class="alert">
				<li>un email de confirmation vous à été envoyé</li>
			</div>
			<?php endif; ?>
				<tr>
					<tr>
						<td><input name="username" type="text" placeholder="name"></td>
					</tr>
					<tr>
						<td><input name="password" type="password" placeholder="password"></td>
					</tr>
					<tr>
						<td><button type="submit">Login</button></td>
					</tr>
				</form>
			</table>
		</div>
	</body>
	</html>