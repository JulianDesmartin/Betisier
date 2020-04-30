<?php
$pdo=new Mypdo();

$villeManager = new VilleManager($pdo);
$villes=$villeManager->getAllVille();
$i = '0';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Lister ville</title>
  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />


</head>
<body>

<?php foreach ($villes as $ville){ ?>
	<?php $i = $i+1; ?>
<?php }?>

<h1>Liste des villes</h1>
<p>Actuellement <?php print_r($i) ?> villes sont enregistrées</p>
<table>
<tr><th>Numéro</th><th>Nom</th></tr>
<?php
foreach ($villes as $ville){ ?>
	<tr><td><?php echo $ville->getVilNum();?>
	</td><td><?php echo $ville->getVilNom();?>
	</td></tr>
<?php }?>
</table>
<br />

</body>
</html>
