<?php
$pdo=new Mypdo();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset= "UTF-8" />
	<title> deconnexion </title>
</head>
<body>
	<h1> Deconnexion </h1>
  <?php
	unset($_SESSION["admin"]);
	unset($_SESSION["username"]);
	echo '<img src="image/valid.png">'." Vous avez bien été déconnecté";
	?><br><?php
  echo "Redirection automatique dans 2 secondes.";
  header("refresh:2;index.php?page=0&connecter=false");
?>
</body>
</html>
