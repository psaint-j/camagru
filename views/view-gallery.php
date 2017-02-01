<?php require_once('config/database.php'); ?>
<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/gallery.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Montserrat|Pacifico|Roboto" rel="stylesheet">
	<title>Camagru - gallery</title>
</head>
<body class="news">
	<header>
		<div class="nav">
			<ul>
				<li><a href="gallery.php"><img id="home" src="svg/home.svg" alt="home"/></a></li>
				<li><a href="menber.php"><img id="btn" src="svg/image.svg" alt="take a picture"/></a></li>
				<li class="logout"><a href="logout.php"><img src="svg/logout2.svg" alt="logout"/></a></li>
			</ul>
		</div>
	</header>
	<?php
		$req = $db->prepare('SELECT user_id, link, at FROM images ORDER BY at DESC');
		$req->execute();
		$var = $req->fetchAll(PDO::FETCH_CLASS);
		foreach ($var as $key => $value) {
			$user = findUser($db, $value->user_id);
			print_r('<div class="box">');
			print_r("<div class='info'>");
			echo "<h4 class='info_user'>$user</h4>";
			echo "<h4 class='info_date'>$value->at</h4>";
			print_r("</div>");
			echo "<img class='img_size' src='"."{$value->link}"."''>";
			print_r("<div class='interaction'>");
			echo "<i id='heart' class='info_heart fa fa-heart-o' aria-hidden='true'></i>";
			print_r('</div>');
			print_r('</div>');
		}
	?>
	<script src="js/gallery.js"></script>
</body>
</html>