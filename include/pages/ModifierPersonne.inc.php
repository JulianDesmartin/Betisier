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
  <title>Modifier Personne</title>
  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />


</head>
<body>
	<h1>Modifier une personne enregistrées</h1>

<?php if (! isset($_GET["modif"]) or $_GET["modif"] == 'false') { ?>

  	<table>
  	<tr><th>Numéro</th><th>Nom</th><th>Prenom</th><th>modifier</th></tr>
  	<?php
  	foreach ($personnes as $personne){?>
  		<?php $num = $personne->getPerNum(); ?>
  		<tr><td><?php echo $num;?>
  		</td><td><?php echo $personne->getPerNom();?>
  		</td><td><?php echo $personne->getPerPre();?>
  		</td>
  		<td><a href="index.php?page=3&modif=true&aModif=<?php echo $num;?>"><img src="image/modifier.png"></a></td>
  	</tr>
  	<?php }?>
  	</table>
  	<br />
  	<p>Cliquez sur la personne à modifier.</p>

  <?php } else if ($_GET["modif"] == 'true'){
    $personneAModif = $personneManager->getPersonne($_GET["aModif"]);

    if ($personneManager->isAnEtudiant($_GET["aModif"])){
    $etudiantAModif = $etudiantManager->getEtudiant($_GET["aModif"]);
     ?>


    <h1>Modifier un etudiant</h1>
    <form action="index.php?page=1" name="personne" id="personne"  method="post">
      Nom :   <input type="text" name="per_nom" value="<?php echo $personneAModif->getPerNom()?>"><br>
      Prenom :   <input type="text" name="per_pre" value="<?php echo $personneAModif->getPerPre()?>"><br>
      Telephone :   <input type="text" name="per_tel" value="<?php echo $personneAModif->getPerTel()?>"><br>
      Mail :   <input type="text" name="per_mail" value="<?php echo $personneAModif->getPerMail()?>"><br>
      Login :   <input type="text" name="per_login" value="<?php echo $personneAModif->getPerAdmin()?>"><br>
      Mot de passe :   <input type="password" name="per_mdp" value="<?php echo $personneAModif->getPerPwd()?>"><br>
      <label>Année : </label>
      <select name="div">
        <option selected value="<?php echo $etudiantManager->getDivEtu($_GET["aModif"])?>"
        <?php foreach ($divisions as $division){ ?>
          <option value="<?php echo $division->getDivNum() ?>"><?php echo $division->getDivNom() ?> </option>
        <?php } ?>
      </select><br>

      <label>Département : </label>
      <select name="dep">
        <option selected value="<?php echo $etudiantManager->getDepEtu($_GET["aModif"])?>"
        <?php foreach ($departements as $departement){ ?>
          <option value="<?php echo $departement->getDepNum() ?>"><?php echo $departement->getDepNom() ?> </option>
        <?php }?>
      </select><br>
      <input type="submit" value="Valider">
    </form>

    <?php
  } else if($personneManager->isASalarie($_GET["aModif"])){


  }

        } ?>

</body>
</html>
