	<html>
	<header>
		<link rel="stylesheet" type="text/css" href="css/confirmation.css">
		<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Montserrat|Pacifico|Roboto" rel="stylesheet">
	</header>
	<body>
		<div class="box">
		<form method="POST">
			<h1>chager de mot de passe</h1>
			<input type="password" placeholder="password" name="password">
			<input type="password" placeholder="re-enter password" name="repassword">
			<button type="submit">reset password</button>
			</form>
		</div>
	<?php if (!empty($flash)): ?>
	<div class="alert aRed">
	<?php foreach ($flash as $var): ?>
		<li><?= $var;?></li>
	<?php endforeach; ?>
	</div>
<?php endif; ?>
	</body>
</html>
