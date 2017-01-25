<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/menber.css">
	<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Montserrat|Pacifico|Roboto" rel="stylesheet">
	<title>Camagru - menber</title>
</head>
<body class="news">
	<header>
		<div class="nav">
			<ul>
				<li><a href="#"><img id="home" src="svg/home.svg" alt="home"/></a></li>
				<li><a href="#"><img id="btn" src="svg/image.svg" alt="take a picture"/></a></li>
				<li class="logout"><a href="logout.php"><img src="svg/logout.svg" alt="logout"/></a></li>
			</ul>
		</div>
	</header>
	<div class="box">
		<video id="video" ></video>
		<button id="startbutton">Prendre une photo</button>
		<canvas class="canvas" id="canvas"></canvas>
	</div>

	<script src="js/camera.js" type="text/javascript"></script>
	<script src="js/app.js" type="text/javascript"></script>
</body>
</html>