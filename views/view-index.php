<!DOCTYPE html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/index.css">
	<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Montserrat|Pacifico|Roboto" rel="stylesheet">
	<title>Camagru - Hello</title>
</head>
<body>
<h1>Camagru</h1>
<div class="box">
<table>
<form action="index.php" method="POST">
<tr>
	<td>
	<?php if (!empty($error)): ?>
	<div class="alert">
	<?php foreach ($error as $var): ?>
		<li><?= $var;?></li>
	<?php endforeach; ?>
	</div>
<?php endif; ?>
	</td>
</tr>
<tr>
	<td><a href="login.php"><button type="button">Login</button></a></td>
</tr>
<tr>
<td><br></td>
</tr>
<tr>
	<td><input type="text" placeholder="name" name="username"></td>
</tr>
<tr>
	<td><input type="email" placeholder="email" name="mail"></td>
</tr>
<tr>
	<td><input type="password" placeholder="password" name="password"></td>
</tr>
<tr>
	<td><input type="password" placeholder="re-enter password" name="repassword"></td>
</tr>
<tr>
	<td><button type="submit">Sign Up</button></td>
</tr>
</form>
</table>
</div>
</body>
</html>