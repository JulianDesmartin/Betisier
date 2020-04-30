<?php
//session_unset();
session_start();

if (isset($_GET['connecter'])){
   $_SESSION['estConnecter'] = $_GET['connecter'];
}
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">
  <?php
		$title = "Bienvenue sur le site du bétisier de l'IUT.";?>
		<title>
		<?php echo $title ?>
		</title>
		<link rel="stylesheet" type="text/css" href="css/stylesheet.css" />
</head>
<body>

	<div id="header">
		<div id="entete">

			<div id="logo">
        <?php
        if(! isset($_SESSION['estConnecter']) or $_SESSION['estConnecter'] == 'false'){
        ?>
          <!--<img src="image/lebetisier.gif" alt="betisier">-->
        <?php
        } else if ($_SESSION['estConnecter'] == 'true'){
        ?>
          <!--<img src="image/smile.jpg" alt="smile">-->
        <?php
        }
        ?>
			</div>

			<div id="titre">
				Le bétisier de l'IUT,<br />Partagez les meilleures perles !!!
			</div>
      <?php
      if (! isset($_SESSION['estConnecter'])){
        ?>
        <div id="connect">
          <a href="index.php?page=9">Connexion</a>
        </div>

        <?php
      } else {
        if ($_SESSION['estConnecter'] == 'true'){
          ?>

          <div id="connect">
            <a>Utilisateur : <?php echo $_SESSION["username"] ?>    </a>
            <a href="index.php?page=10">Deconnexion</a>
          </div>

          <?php
        } else  {
          ?>

          <div id="connect">
            <a href="index.php?page=9">Connexion</a>
          </div>

          <?php
        }
      }
      ?>
		</div>
	</div>
</body>
</html>
