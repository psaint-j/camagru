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
				<li class="logout"><a href="logout.php"><img src="svg/logout2.svg" alt="logout"/></a></li>
			</ul>
		</div>
	</header>
<div class="box">
<div class="box_left">
<table>
<tr>
	<td><img src="img/img1.png" alt=""></td>
	<td><img src="img/img2.png" alt=""></td>
	<td><img src="img/img4.png" alt=""></td>
	<td><img src="img/img5.png" alt=""></td>
</tr>
<tr>
	<td><input type="checkbox" id="cbox1" onclick="selectOnlyThis(this.id)"></td>
	<td><input type="checkbox" id="cbox2" onclick="selectOnlyThis(this.id)"></td>
	<td><input type="checkbox" id="cbox3" onclick="selectOnlyThis(this.id)"></td>
	<td><input type="checkbox" id="cbox4" onclick="selectOnlyThis(this.id)"></td>
</tr>			
</table>
	</div>
	<div class="box_center">
		<video id="video" ></video>
		<button id="startbutton">Prendre une photo</button>
		<canvas class="canvas" width="560" height="400" id="canvas"></canvas>
	</div>
	
</div>
	<script src="js/camera.js" type="text/javascript"></script>
	<script src="js/app.js" type="text/javascript"></script>
</body>
</html>