<?php

class PersonneManager {
	private $dbo;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($personne){
		$requete = $this->db->prepare(
			'INSERT INTO personne (per_nom, per_prenom, per_tel, per_mail, per_admin, per_login, per_pwd) VALUES (:per_nom, :per_prenom, :per_tel, :per_mail, :per_admin, :per_login, :per_pwd)');
		$requete->bindValue(':per_nom',$personne->getPerNom());
		$requete->bindValue(':per_prenom',$personne->getPerPre());
		$requete->bindValue(':per_tel',$personne->getPerTel());
		$requete->bindValue(':per_mail',$personne->getPerMail());
		$requete->bindValue(':per_admin',$personne->getPerAdmin());
		$requete->bindValue(':per_login',$personne->getPerLogin());
		$requete->bindValue(':per_pwd',$personne->getPerPwd());
		$retour=$requete->execute();
		return $retour;
	}
	public function getAllPersonne(){
		$listePersonne = array();
		$sql = 'SELECT per_num,per_nom,per_prenom FROM personne';
		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($personne = $requete->fetch(PDO::FETCH_OBJ))
			$listePersonne[] = new Personne($personne);

		$requete->closeCursor();
		return $listePersonne;
	}

	public function getAllEnseignant(){
		$listePersonne = array();
		$sql = 'SELECT p.per_num,per_nom,per_prenom FROM personne p
							JOIN salarie s ON p.per_num = s.per_num
							JOIN fonction f ON s.fon_num = f.fon_num
							WHERE fon_libelle = "Enseignant" ';
		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($personne = $requete->fetch(PDO::FETCH_OBJ))
			$listePersonne[] = new Personne($personne);

		$requete->closeCursor();
		return $listePersonne;
	}

	public function isAnEtudiant($numero){
	    $sql = 'select per_num from etudiant
	            where per_num = :num';

	    $requete = $this->db->prepare($sql);
	    $requete->bindValue(':num', $numero, PDO::PARAM_INT);

	    $requete->execute();


	    $personne=$requete->fetch(PDO::FETCH_OBJ);
	    $requete->closeCursor();

	    if ($personne){
	        return 1;
	    }else{
	        return 0;
	    }
	}

	public function isASalarie($numero){
	    $sql = 'select per_num from salarie
	            where per_num = :num';

	    $requete = $this->db->prepare($sql);
	    $requete->bindValue(':num', $numero, PDO::PARAM_INT);

	    $requete->execute();


	    $personne=$requete->fetch(PDO::FETCH_OBJ);
	    $requete->closeCursor();

	    if ($personne){
	        return 1;
	    }else{
	        return 0;
	    }
	  }

		public function getPersonne ($per_num){
			$sql = "SELECT * FROM personne WHERE per_num = $per_num";
			$requete = $this->db->prepare($sql);
			$requete->bindValue(':per_num',$per_num,PDO::PARAM_INT);
			$requete->execute();
			$pers = $requete->fetch(PDO::FETCH_OBJ);
			$newPersonne = new Personne($pers);
			return $newPersonne;
		}

		public function isAdmin($username){
			$sql = "SELECT per_admin FROM personne WHERE per_login = '$username'";
			$requete = $this->db->prepare($sql);
			$requete->bindValue(':per_login',$username,PDO::PARAM_INT);
			$requete->execute();
			$pers = $requete->fetch(PDO::FETCH_OBJ);

			return $pers->per_admin;
		}


		public function loginUser($username,$password){
			$listePersonne = array();
			$salt = "48@!alsd";
			$pwd_crypte = sha1(sha1($password).$salt);
			$sql = "SELECT * FROM personne WHERE per_login ='$username' AND per_pwd ='$pwd_crypte'";
			$requete = $this->db->prepare($sql);
			$requete->execute();

			while ($personne = $requete->fetch(PDO::FETCH_OBJ))
				$listePersonne[] = new Personne($personne);

			return $listePersonne;
		}

		public function userCreer($login){
			$sql = "SELECT * FROM personne WHERE per_login = $login";
			$requete = $this->db->prepare($sql);
			if ($requete != NULL){
				return true;
			}
			return false;
		}

		public function getId($username){
				$sql = "SELECT per_num FROM personne WHERE per_login = '$username'";
				$requete = $this->db->prepare($sql);
				$requete->bindValue(':per_login',$username,PDO::PARAM_INT);
				$requete->execute();
				$pers = $requete->fetch(PDO::FETCH_OBJ);

				return $pers->per_num;
		}
		public function getPerNom($num){
				$sql = "SELECT per_nom FROM personne WHERE per_num = '$num'";
				$requete = $this->db->prepare($sql);
				$requete->bindValue(':per_num',$num,PDO::PARAM_INT);
				$requete->execute();
				$pers = $requete->fetch(PDO::FETCH_OBJ);

				return $pers->per_nom;
		}
		public function getPerPre($num){
				$sql = "SELECT per_prenom FROM personne WHERE per_num = '$num'";
				$requete = $this->db->prepare($sql);
				$requete->bindValue(':per_num',$num,PDO::PARAM_INT);
				$requete->execute();
				$pers = $requete->fetch(PDO::FETCH_OBJ);

				return $pers->per_prenom;
		}

		public function supprimerPersonne($id){
			$sql = "DELETE FROM personne WHERE per_num = $id";
			$requete = $this->db->prepare($sql);
			$requete->execute();
		}

}
?>
