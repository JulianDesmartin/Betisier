<?php
$pdo=new Mypdo();

$personneManager = new PersonneManager($pdo);
$personnes = $personneManager->getAllPersonne();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset= "UTF-8" />
	<title> connexion </title>
</head>
<body>
	<h1> Pour vous connecter </h1>
	<form action="" name="info" id="info"  method="post">
		<label> Nom d'utilisateur : </label>
		<input type="text" name="username" required><br>
		<label>Mot de passe :</label>
		<input type="password" name="password" required><br>
		<label>8 + 5 = </label>
		<input type="text" id="calcul" name="calcul" required><br>

		<input type="submit" id='submit' value='Valider' >
		<?php

		if(isset($_GET['erreur'])){
			$err = $_GET['erreur'];
			if($err==1)
				echo "Utilisateur ou mot de passe incorrect";
			}

		?>

		<?php
		if(empty($_POST['username']) and empty($_POST['password']) and empty($_POST['calcul'])){
		}	else {

			$username=$_POST["username"];
			$calcul=$_POST["calcul"];
			$mdp=$_POST["password"];


			if($calcul == 13 )
	    {
				$bonLogin = $personneManager->loginUser($username,$mdp);
				if(!(empty($bonLogin))){
					$_SESSION["username"] = $username;
					$_SESSION["admin"] = $personneManager->isAdmin($username);

					?><br><?php
					echo '<img src="image/valid.png">'." vous avez bien ete connecte !";
					?><br><?php
					echo "Redirection automatique dans 2 secondes.";
					header("refresh:2;index.php?page=0&connecter=true");
				}
				else {
					header('Location: index.php?page=9&erreur=1');
				}
			}
		}?>

	</form>

</body>
</html>
