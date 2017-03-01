<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/login.css">
	<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Montserrat|Pacifico|Roboto|Grand+Hotel|Patrick+Hand+SC|Knewave|Reenie+Beanie|Rock+Salt|Poiret+One|Kaushan+Script|Amatic+SC" rel="stylesheet">
	<title>Camagru - login</title>
</head>
<body>
	<a href="index.php"><h1 class="title">C A M A G R U</h1></a>
	<?php if (!empty($error)): ?>
		<div class="alert">
	<?php foreach ($error as $var): ?>
		<li><?= $var;?></li>
	<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<div class="box">
		<table>
			<form action="login.php" method="POST">
			<?php if ($_GET['account'] == md5("true")): ?>
			<div class="alert aGreen">
				<li>un email de confirmation vous à été envoyé</li>
			</div>
			<?php endif; ?>
				<?php if ($_GET['account'] == md5("reset")): ?>
			<div class="alert aGreen">
				<li>Votre mot de passe à bien était changer</li>
			</div>
			<?php endif; ?>
				<tr>
					<tr>
						<td><input name="username" type="text" placeholder="pseudo"></td>
					</tr>
					<tr>
						<td><input name="password" type="password" placeholder="password"></td>
					</tr>
					<tr>
						<td><button type="submit">Connexion</button></td>
					</tr>
					<tr><td><a class="reset" href="reset.php">mot de passe oublié ?</a></td></tr>
				</form>
			</table>
		</div>
			<?php if (!empty($error)): ?>
	<div class="alert aRed">
	<?php foreach ($error as $var): ?>
		<li><?= $var;?></li>
	<?php endforeach; ?>
	</div>
<?php endif; ?>
	</body>
	</html>