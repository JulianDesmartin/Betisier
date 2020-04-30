<?php
$pdo=new Mypdo();

$salarieManager = new SalarieManager($pdo);

$etudiantManager = new EtudiantManager($pdo);

$personneManager = new PersonneManager($pdo);
$personnes = $personneManager->getAllPersonne();
?>
<!DOCTYPE html>
<html>
<head>
  <title>Supprimer Personne</title>
  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />


</head>
<body>
	<h1>Supprimer des personnes enregistrées</h1>

<?php if (! isset($_GET["supr"]) or $_GET["supr"] == 'false') { ?>

	<table>
	<tr><th>Numéro</th><th>Nom</th><th>Prenom</th><th>supprimer</th></tr>
	<?php
	foreach ($personnes as $personne){?>
		<?php $num = $personne->getPerNum(); ?>
		<tr><td><?php echo $num;?>
		</td><td><?php echo $personne->getPerNom();?>
		</td><td><?php echo $personne->getPerPre();?>
		</td>
		<td><a href="index.php?page=4&supr=true&aSupr=<?php echo $num;?>"><img src="image/erreur.png"></a></td>
	</tr>
	<?php }?>
	</table>
	<br />
	<p>Cliquez sur la personne à supprimer.</p>

<?php } else if ($_GET["supr"] == 'true'){

				if ($personneManager->isAnEtudiant($_GET["aSupr"])){
						$etudiantManager->supprimerEtudiant($_GET["aSupr"]);
						$personneManager->supprimerPersonne($_GET["aSupr"]);
				} else if ($personneManager->isASalarie($_GET["aSupr"])){
						$salarieManager->supprimerSalarie($_GET["aSupr"]);
						$personneManager->supprimerPersonne($_GET["aSupr"]);
				}
			echo 'personne supprimer !';
			header("refresh:2;index.php?page=4&supr=false");
			} ?>

</body>
</html>
