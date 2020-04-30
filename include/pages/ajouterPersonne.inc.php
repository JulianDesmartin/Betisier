<?php
$pdo=new Mypdo();

$divisionManager = new DivisionManager($pdo);
$divisions = $divisionManager->getAllDivision();
$departementManager = new DepartementManager($pdo);
$departements = $departementManager->getAllDepartement();
$fonctionManager = new FonctionManager($pdo);
$fonctions = $fonctionManager->getAllFonction();

$newPersonne = new Personne($pdo);
$personneManager = new PersonneManager($pdo);
$newEtudiant = new Etudiant($pdo);
$etudiantManager = new EtudiantManager($pdo);
$newSalarie = new Salarie($pdo);
$salarieManager = new SalarieManager($pdo);


?>
<!DOCTYPE html>
<html>
<head>
  <title>creerPersonne</title>
  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />


</head>
<body>

<?php

if(!(isset($_SESSION['fonctionPers']))) { ?>

	<h1>Ajouter une personne</h1>
  <form action="index.php?page=1" name="personne" id="personne"  method="post">
  	Nom :   <input type="text" id="per_nom" name="per_nom"><br>
  	Prenom :   <input type="text" id="per_pre" name="per_pre"><br>
  	Telephone :   <input type="text" id="per_tel" name="per_tel"><br>
  	Mail :   <input type="text" id="per_mail" name="per_mail"><br>
  	Login :   <input type="text" id="per_login" name="per_login"><br>
  	Mot de passe :   <input type="password" id="per_mdp" name="per_mdp"><br>
  	<div>
  		<input type="radio" id="per_fonction_etu" name="per_fonction" value="Etudiant">
  		<label for="Etudiant">Etudiant</label>
  	</div>
  	<div>
  		<input type="radio" id="per_fonction_sal" name="per_fonction" value="Salarie">
  		<label for="Salarie">Salarie</label><br>
  	</div>
  	<input type="submit" value="Valider">
  </form>

  <?php
	if(empty($_POST['per_nom']) and empty($_POST['per_pre']) and empty($_POST['per_tel']) and empty($_POST['per_mail']) and empty($_POST['per_login']) and empty($_POST['per_pwd'])){

	}
	else {
  		echo "fonction = ".$_POST["per_fonction"]."<br />";
  		$newPersonne->setPerNom($_POST['per_nom']);
  		$newPersonne->setPerPre($_POST["per_pre"]);
  		$newPersonne->setPerTel($_POST["per_tel"]);
  		$newPersonne->setPerMail($_POST["per_mail"]);
  		$newPersonne->setPerAdmin();
  		$newPersonne->setPerLogin($_POST["per_login"]);
  		$newPersonne->setPerPwd($_POST["per_mdp"]);

  		echo "info actuelle :<br />";
  		echo "Nom = ".$_POST["per_nom"]."<br />";
  		echo "Prenom = ".$_POST["per_pre"]."<br />";
  		echo "Telephone = ".$_POST["per_tel"]."<br />";
  		echo "Mail = ".$_POST["per_mail"]."<br />";
  		echo "Login = ".$_POST["per_login"]."<br />";
  		echo "Password (temporaire) = ".$_POST["per_mdp"]."<br />";
      $_SESSION['loginUser'] = $_POST["per_login"];
      $_SESSION['fonctionPers'] = $_POST['per_fonction'];
      echo "fonction = ".$_SESSION['fonctionPers']."<br />";

  		$personneManager->add($newPersonne);

  		if ($personneManager->userCreer($_POST["per_login"])){
        header("refresh:0;index.php?page=1&etuAjouter=false&salAjouter=false");
  		}
  		else {
  			echo "desoler, recommence";
  		}
	}

?>
<?php
} else if ($_SESSION['fonctionPers'] == 'Etudiant' or $_SESSION['fonctionPers'] == 'Salarie'){

    $id = $personneManager->getID($_SESSION['loginUser']);

    if($_SESSION['fonctionPers'] == 'Etudiant'){
        if(! isset($_SESSION['Succes'])) {
          ?>
          <form action="" method="post">

            <label>Année : </label>
            <select name="div">
              <?php foreach ($divisions as $division){ ?>
                <option value="<?php echo $division->getDivNum() ?>"><?php echo $division->getDivNom() ?> </option>
              <?php } ?>
            </select><br>

            <label>Département : </label>
            <select name="dep">
              <?php foreach ($departements as $departement){ ?>
                <option value="<?php echo $departement->getDepNum() ?>"><?php echo $departement->getDepNom() ?> </option>
              <?php }?>
            </select><br>

            <input type="submit" value="Valider" name="valider">
          </form>
          <?php
            if(isset($_POST["valider"])){
              header("refresh:0;index.php?page=1");
              $newEtudiant->setEtuNum($id);
              $newEtudiant->setEtuDep($_POST['dep']);
              $newEtudiant->setEtuDiv($_POST['div']);

              $etudiantManager->add($newEtudiant);
              $_SESSION['Succes'] = 'true';

            }

      } else {
          echo "L'étudiant a été ajouté !";
          unset($_SESSION['fonctionPers']);
          unset($_SESSION['Succes']);
          header("refresh:2;index.php?page=1");
      }

  } else if($_SESSION['fonctionPers'] == 'Salarie'){
      if(! isset($_SESSION['Succes'])) {
        ?>
        <form action="" method="post">

          <label>Téléphone professionel : </label>
          <input name="telpro" type="tel">
          <br>

          <label>Fonction : </label>
          <select name="fon">
            <?php foreach ($fonctions as $fonction){ ?>
              <option value="<?php echo $fonction->getFonNum() ?>"><?php echo $fonction->getFonLibelle() ?> </option>
            <?php }?>
          </select><br>

          <input type="submit" value="Valider" name="valider">
        </form>
        <?php
          if(isset($_POST["valider"])){
            header("refresh:0;index.php?page=1");
            $newSalarie->setSalNum($id);
            $newSalarie->setSalTelPro($_POST['telpro']);
            $newSalarie->setSalFonction($_POST['fon']);

            $salarieManager->add($newSalarie);
            $_SESSION['Succes'] = 'true';
          }

    } else {
        echo "Le salarié a été ajouté !";
        unset($_SESSION['fonctionPers']);
        unset($_SESSION['Succes']);
        header("refresh:2;index.php?page=1");
    }
  } else {
    echo 'erreur';
    unset($_SESSION['fonctionPers']);
  }


} else {
  echo 'erreur';
}
?>

</body>
</html>
