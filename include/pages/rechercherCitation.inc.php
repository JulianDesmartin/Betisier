<?php
$pdo=new Mypdo();
$citationManager = new CitationManager($pdo);

$personneManager = new PersonneManager($pdo);
$personnes = $personneManager->getAllEnseignant();


?>

<!DOCTYPE html>
<html>
<head>
  <title>rechercher citation</title>
  <meta charset="utf-8">

</head>
<body>
<h1>Rechercher une citation</h1>
<form>
  <label>nom de l'enseignant : </label>
    <select name="prof">
      <option selected value="">...</option>
      <?php foreach ($personnes as $personne){ ?>
        <option value="<?php echo $personne->getPerNum() ?>"><?php echo $personne->getPerNom() ?> </option>
      <?php }?>
    </select><br>
  <label>date : </label>
    <input type="date" name="date"><br>
  <label>note obtenue : </label>
    <input type="number" name="note" min="0" max="20"><br>
    <input type="submit" value="Valider">
</form>

<?php
  if(! empty($_POST['prof']) and ! empty($_POST['date']) and ! empty($_POST['note'])){
    $citations = $citationManager->getCitationWithParam($_POST['prof'],$_POST['date'],$_POST['note']);
    ?>
    <table>
    <tr><th>Nom de l'enseignant </th><th>Libellé</th><th>Date</th><th>Moyenne des notes</th><th>Noter</th></tr>
    <?php
    foreach ($citations as $citation){?>
    	<tr><td><?php echo $personneManager->getPerNom($citation->getPerNumCit()); echo $personneManager->getPerPre($citation->getPerNumCit());?>
    	</td><td><?php echo $citation->getCitLib();?>
    	</td><td><?php echo $citation->getCitDate();?>
    	</td><td><?php echo $voteManager->getMoyenneVoteCitation($citation->getCitNum());?>
    	</td></tr>
    <?php } ?>
    </table>

    <?php
  }else if (! empty($_POST['prof']) and ! empty($_POST['date']) and empty($_POST['note'])){

  }else if (! empty($_POST['prof']) and  empty($_POST['date']) and ! empty($_POST['note'])) {

  }else if ( empty($_POST['prof']) and ! empty($_POST['date']) and ! empty($_POST['note'])){

  }else if (! empty($_POST['prof']) and empty($_POST['date']) and empty($_POST['note'])){

  }else if ( empty($_POST['prof']) and ! empty($_POST['date']) and empty($_POST['note'])){

  }else if ( empty($_POST['prof']) and empty($_POST['date']) and ! empty($_POST['note'])){

  }else{
    echo '* remplir au moin un des champs si dessus !';
  }
?>


</body>
</html>
