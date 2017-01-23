<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/menber.css">
	<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Montserrat|Pacifico|Roboto" rel="stylesheet">
	<link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
	<title>Camagru - menber</title>
</head>
<body class="news">
	<header>
		<div class="nav">
			<ul>
				<li class="home"><a href="#"><img src="svg/safari.svg" /></a></li>
				<li class="about"><a href="#"><img src="svg/photos.svg" /></a></li>
				<li class="contact"><a href="logout.php"><img src="svg/logout.svg" /></a></li>
			</ul>
		</div>
	</header>
	<div class="box">
		<video id="video" width="640" height="480" autoplay></video>
		<button id="startbutton">Prendre une photo</button>
		<canvas id="canvas" width="640" height="480"></canvas>
		<img src="http://placekitten.com/g/320/261" id="photo" alt="photo">
	</div>
	<script src="js/camera.js" type="text/javascript"></script>
</body>
</html>