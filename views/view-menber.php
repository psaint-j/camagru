<?php 
require('config/database.php');
require('config/session.php');
?>
<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/menber.css">
	<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Montserrat|Pacifico|Roboto|Amatic+SC" rel="stylesheet">
	<title>Camagru - menber</title>
</head>
<body class="news">
	<header>
		<div class="nav">
			<ul>
				<li><h4 class="user_log"><?php print($_SESSION['username']); ?></h4></li>
				<li><a href="gallery.php?p=1"><img id="home" src="svg/home.svg" alt="home"/></a></li>
				<li><a href="menber.php"><img id="btn" src="svg/image.svg" alt="take a picture"/></a></li>
				<li class="logout"><a href="logout.php"><img src="svg/logout.svg" alt="logout"/></a></li>
			</ul>
		</div>
	</header>
	<div class="box">
		<table class="main_table">
			<td>
				<div class="box_left">
					<table>
						<tr>
							<td><img src="img/img1.png" alt="mario"></td>
							<td><img src="img/img2.png" alt="monkey"></td>
							<td><img src="img/img4.png" alt="heisenberg"></td>
							<td><img src="img/img3.png" alt="cool story bro"></td>
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
			</td>
			<?php 
			$test = ifUserImage($db, $_SESSION['id']);
			if ($test) {
				echo "<td class='aaudiber'>
				<div class='img_user'>";
					getUserImage($db, $_SESSION['id']);
					echo"</div>
				</td>
			</table>	
		</div>";
	}
	?>
<!-- 	<form  method="post" enctype="multipart/form-data">
	Select image to upload:
	<input type="file" name="fileToUpload" id="fileToUpload">
	<input id="upload" type="submit" value="Upload Image" name="submit" onclick="function({$_SESSION['upload']})">
	</form> -->
	<script src="js/camera.js" type="text/javascript"></script>
	<script src="js/app.js" type="text/javascript"></script>
</body>
</html>