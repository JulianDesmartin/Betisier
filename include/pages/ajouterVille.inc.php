<?php
$pdo=new Mypdo();

$nouvelleVille = new Ville($pdo);
$villeManager = new VilleManager($pdo);
$villes = $villeManager->getAllVille();
$vil_num = "0";
?>
<!DOCTYPE html>
<html>
<head>
  <title>ajouter ville</title>
  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />


</head>
<body>

<?php
if ( ! isset($_GET['ajouter'])){ ?>


	<h1>Ajouter une ville</h1>
	<form action="#" name="info" id="info"  method="post">
		Nom :   <input type="text" id="vil_nom" name="vil_nom"><br>
		<input type="submit" value="Valider">
	</form>
	<?php
	if(! empty($_POST['vil_nom'])){

		$vil_nom = $_POST["vil_nom"];
		$_SESSION['newVille'] = $vil_nom;


		$nouvelleVille->setVilNom($_POST["vil_nom"]);
		$villeManager->add($nouvelleVille);
		header("refresh:2;index.php?page=7&ajouter=true");
	}
}
else {
		if ($_GET['ajouter'] == 'true') {
			echo '<img src="image/valid.png">'.'La ville ';
			echo $_SESSION['newVille'];
			echo ' a été ajouté';
			header("refresh:2;index.php?page=7&ajouter=false");

	}
	else if ($_GET['ajouter'] == 'false') { ?>
		<p>insérer un nom</p>


		<h1>Ajouter une ville</h1>
		<form action="#" name="info" id="info"  method="post">
			Nom :   <input type="text" id="vil_nom" name="vil_nom"><br>
			<input type="submit" value="Valider">
		</form>
	<?php }

	if(! empty($_POST['vil_nom'])){
		$vil_nom=$_POST["vil_nom"];
		$nouvelleVille->setVilNom($_POST["vil_nom"]);
		$villeManager->add($nouvelleVille);
		header("refresh:0;index.php?page=7&ajouter=true");

	}
}
?>
</body>
</html>
