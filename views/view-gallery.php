<?php 
require_once('config/database.php');
require_once('config/session.php');
?>
<!doctype html>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/gallery.css">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	<link href="https://fonts.googleapis.com/css?family=Bungee+Shade|Montserrat|Pacifico|Roboto|Grand+Hotel|Patrick+Hand+SC|Knewave|Reenie+Beanie|Rock+Salt|Poiret+One|Kaushan+Script|Amatic+SC|Cantarell" rel="stylesheet">
	<title>Camagru - gallery</title>
</head>
<body class="news">
	<header>

		<div class="nav">
			<ul>
			<?php if ($_SESSION['id']){
				echo '<li><h4 class="user_log">'.$_SESSION["username"].'</h4></li>
		<li><a href="gallery.php?p=1"><img id="home" src="svg/home.svg" alt="home"/></a></li>
		<li><a href="menber.php"><img id="btn" src="svg/image.svg" alt="take a picture"/></a></li>
			 <li class="logout"><a href="logout.php"><img src="svg/logout.svg" alt="logout"/></a></li>';
			 }
			 else
			 {
			 		echo "<a href='index.php'><h1>C A M A G R U</h1></a>";
			 		echo "<a href='signin.php'><h4>S'incrire | connextion<h4></a>";
			 }
				?>
			</ul>
		</div>
	</header>
	<?php
	$nbpost = CountPost($db);
	$perPage = 4;
	$nbPage = ceil($nbpost/$perPage);
	$cPage = htmlentities($_GET['p']);
	//var_dump($cPage)
	$current = (($cPage - 1) * $perPage);
	if ($current >= 0 && $cPage <= $nbPage)
	{
	$req = $db->prepare("SELECT id, user_id, link, at FROM images ORDER BY at DESC LIMIT $current, $perPage");
	$req->execute();
	$var = $req->fetchAll(PDO::FETCH_CLASS);
	foreach ($var as $key => $value) {
		$user = findUser($db, $value->user_id);
		$req2 = $db->prepare('SELECT id FROM likes WHERE image_id = ? AND user_id = ?');
		$req2->execute(array($value->id, $_SESSION['id']));
		$on = $req2->fetch();
		print_r('<div class="box">');
		print_r("<div class='info'>");
		echo "<h4 class='info_user'>$user</h4>";
		print_r("</div>");
		echo "<img id='i{$value->id}' class='img_size' src='"."{$value->link}"."''>";
		echo "<div class='comment{$value->id} comment'>";
		getComments($db, $value->id);
		echo "</div>";
		if ($_SESSION['id']) {
		print_r("<div class='interaction'>");
		if($on)
		{
			echo "<i id='{$value->id}' class='fa fa-heart heart_s' aria-hidden='true' onclick='likeImg(this.id)' style='font-size: 23px;color:red;'></i>";
		}
		else
		{
			echo "<i id='{$value->id}' class='fa fa-heart-o heart_s' aria-hidden='true' onclick='likeImg(this.id)' style='font-size: 23px;@media screen and (min-width: 200px) and (max-width: 1024px){font-size: 57px;}'></i>";
		}
		echo "<input id='c{$value->id}' class='comment' type='text' placeholder='Add comment...' maxlength='1000' autocomplete='off' onkeypress='comment({$value->id})'>";
		print_r('</div>');
		}
		print_r('</div>');
	}
}
else
{
	require_once('views/view-error.php');
	if ($nbpost == 0)
	{
		roll_safe("Tu peux pas voir la galerie s'il y a rien a afficher");
	}
	else
	{
		roll_safe("Tu peut pas voir cette page si t'es sur la page 404");
	}
}
	?>
	<?php 
	print_r('<div class="box box_pagination">');
	if ($nbPage != 1){		
	for ($i=1; $i <= $nbPage; $i++) {
		if ($i == $cPage	){
			echo "<a style='color:red;' class='pagination' href='gallery.php?p={$i}'>{$i} </a> ° ";
		}
		else
		{
			echo "<a class='pagination' href='gallery.php?p={$i}'>{$i} </a> ° ";
		}
	}
	}
	print_r('</div>');
	?>
	<script src="js/gallery.js"></script>
</body>

</html>

