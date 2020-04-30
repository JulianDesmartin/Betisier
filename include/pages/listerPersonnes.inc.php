<?php
$pdo=new Mypdo();

$salarieManager = new SalarieManager($pdo);
$salaries = $salarieManager->getAllSalarie();


$etudiantManager = new EtudiantManager($pdo);
$etudiants = $etudiantManager->getAllEtudiant();

$personneManager = new PersonneManager($pdo);
$personnes = $personneManager->getAllPersonne();

$i = '0';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Lister personne</title>
  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />


</head>
<body>

	<?php foreach ($personnes as $personne){ ?>
		<?php $i = $i+1; ?>
	<?php }

if(! isset($_GET['numper'])){

?>

	<h1>Liste des personnes enregistrées</h1>
	<p>Actuellement <?php print_r($i) ?> personnes sont enregistrées</p>
	<table>
	<tr><th>Numéro</th><th>Nom</th><th>Prenom</th></tr>
	<?php
	foreach ($personnes as $personne){?>
		<?php $num = $personne->getPerNum(); ?>
		<tr><td><a <?php echo "href=\"index.php?page=2&numper=".$num."\""; ?>><?php echo $num;?></a>
		</td><td><?php echo $personne->getPerNom();?>
		</td><td><?php echo $personne->getPerPre();?>
		</td></tr>
	<?php }?>
	</table>
	<br />
	<p>Cliquez sur le numéro de la personne pour obtenir plus d'informations.</p>


<?php
} else if (isset($_GET['numper'])){


if ($personneManager->isASalarie($_GET['numper']) == 1){ ?>

	<?php
		$detailSal = $personneManager->getPersonne($_GET['numper']);
		?>
			<h1>Détail sur le salairé <?php echo $detailSal->getPerNom(); ?></h1>
			<table>
			<tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Tel pro</th><th>Fonction</th></tr>
				<tr><td><?php  echo $detailSal->getPerPre();?>
				</td><td><?php  echo $detailSal->getPerMail();?>
				</td><td><?php  echo $detailSal->getPerTel();?>
				</td><td><?php  echo $salarieManager->getTelPro($_GET['numper']);?>
				</td><td><?php  echo $salarieManager->getFonctionSal($_GET['numper']);?>
				</td></tr>
			</table>
			<br />
	<?php
} else if ($personneManager->isAnEtudiant($_GET["numper"]) == 1) { ?>

	<?php
		$detailEtu = $personneManager->getPersonne($_GET['numper']);
		?>
			<h1>Détail sur l'éudiant <?php echo $detailEtu->getPerNom(); ?></h1>
			<table>
			<tr><th>Prénom</th><th>Mail</th><th>Tel</th><th>Département</th><th>Ville</th></tr>
				<tr><td><?php  echo $detailEtu->getPerPre();?>
				</td><td><?php  echo $detailEtu->getPerMail();?>
				</td><td><?php  echo $detailEtu->getPerTel();?>
				</td><td><?php  echo $etudiantManager->getDepEtu($_GET['numper']);?>
				</td><td><?php  echo $etudiantManager->getVilEtu($_GET['numper']);?>
				</td></tr>
			</table>
			<br />
	<?php
	}
}?>
</body>
</html>
