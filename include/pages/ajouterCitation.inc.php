<?php
$pdo=new Mypdo();

$nouvelleCitation = new Citation($pdo);
$citationManager = new CitationManager($pdo);

$motManager = new MotManager($pdo);
$mots = $motManager->getAllMot();

$personneManager = new PersonneManager($pdo);
$personnes = $personneManager->getAllEnseignant();

?>
<!DOCTYPE html>
<html>
<head>
  <title>ajouter citation</title>
  <meta charset="utf-8">
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />


</head>
<body>

<?php
if (! isset($_SESSION['citationAjouter'])){ ?>
  <h1>Ajouter une citation</h1>
  <form action="#" name="citation" id="citation"  method="post">
    <label>Enseignant : </label>
    <select name="prof">
      <?php foreach ($personnes as $personne){ ?>
        <option value="<?php echo $personne->getPerNum() ?>"><?php echo $personne->getPerNom() ?> </option>
      <?php }?>
    </select><br>
        <label>Date : </label>
	      <input type="date" id="date" name="date"><br>
        <label>Citation : </label>
        <textarea id="citation" name="citation"></textarea><br>
		<input type="submit" value="Valider">
	</form>
  <?php
  if(! empty($_POST['date']) and ! empty($_POST['citation'])){

    header("refresh:2;index.php?page=5");
    $perNumEtu = $personneManager->getId($_SESSION["username"]);

    $nouvelleCitation->setPerNum($_POST['prof']);
    $nouvelleCitation->setPerNumEtu($perNumEtu);
    $nouvelleCitation->setCitDate($_POST['date']);
    $nouvelleCitation->setCitLib($_POST['citation']);

    $citationManager->add($nouvelleCitation);
    $_SESSION['citationAjouter'] = '1';

  }
  else if (! empty($_POST['date']) or ! empty($_POST['citation'])) {
    echo ' * champ obligatoire : Enseignant / Date Citation / Citation ';
  }
  ?>
<?php
} else {
  echo 'La Citation a été ajouté et validé !';
  unset($_SESSION['citationAjouter']);
  header("refresh:2;index.php?page=5");
}
?>
</body>
</html>
