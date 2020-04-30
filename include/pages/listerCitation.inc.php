<?php
$pdo=new Mypdo();

$citationManager = new CitationManager($pdo);
$citations = $citationManager->getAllCitationValideV2();

$personneManager = new PersonneManager($pdo);

$voteManager = new VoteManager($pdo);
$newVote = new Vote($pdo);

$i = '0';
?>

<!DOCTYPE html>
<html>
<head>
  <title>Lister citation</title>
  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />


</head>
<body>

<?php foreach ($citations as $citation){ ?>
	<?php $i = $i+1; ?>
<?php }?>


<h1>Liste des citations déposées </h1>
<p>Actuellement <?php print_r($i) ?> citations sont enregistrées</p>

<?php if(isset($_SESSION["username"])) { ?>

<table>
<tr><th>Nom de l'enseignant </th><th>Libellé</th><th>Date</th><th>Moyenne des notes</th><th>Noter</th></tr>
<?php

	foreach ($citations as $citation){?>
		<tr><td><?php echo $personneManager->getPerNom($citation->getPerNumCit()); echo $personneManager->getPerPre($citation->getPerNumCit());?>
		</td><td><?php echo $citation->getCitLib();?>
		</td><td><?php echo $citation->getCitDate();?>
		</td><td><?php echo $voteManager->getMoyenneVoteCitation($citation->getCitNum());?>
		</td><?php
				$aDejaVote = $voteManager->aVoter($citation->getCitNum(),$personneManager->getId($_SESSION["username"]));
				if(! empty($aDejaVote)){ ?>
					<td><img src="image/erreur.png"></td>
	<?php	}
				else{
					if (! isset($_GET['noter']) or $_GET['noter'] == 'true') {?>
						<td><a href="index.php?page=6&noter=false&citnum=<?php echo $citation->getCitNum();?>&pernum=<?php echo $citation->getPerNumCit();?>"><img src="image/modifier.png"></a></td>
	<?php		} else { ?>
							<td>
							<form action="" method="post">
								<label> Note : </label>
								<input type="number" name="note" min="0" max="20">
								<input type="submit" value="Valider">
							</form>
							</td>
							<?php
							if(! empty($_POST['note'])){
								echo $_POST['note'];
								echo $_GET['citnum'];
								echo $_GET['pernum'];
								$newVote->setCitNum($_GET['citnum']);
								$newVote->setPerNum($_GET['pernum']);
								$newVote->setVotValeur($_POST['note']);

								$voteManager->add($newVote);
								header("refresh:2;index.php?page=6&noter=true");
							}
						}
				}
		 ?>
		</tr>
	<?php }?>
	</table>

<?php } else { ?>

	<table>
	<tr><th>Nom de l'enseignant </th><th>Libellé</th><th>Date</th><th>Moyenne des notes</th></tr>
	<?php

		foreach ($citations as $citation){?>
			<tr><td><?php echo $personneManager->getPerNom($citation->getPerNumCit()); echo $personneManager->getPerPre($citation->getPerNumCit());?>
			</td><td><?php echo $citation->getCitLib();?>
			</td><td><?php echo $citation->getCitDate();?>
			</td><td><?php echo $voteManager->getMoyenneVoteCitation($citation->getCitNum());?>
			</td></tr>
<?php }?>
		</table>

<?php } ?>
<br />

</body>
</html>
