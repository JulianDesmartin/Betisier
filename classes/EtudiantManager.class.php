<?php

class EtudiantManager {
	private $dbo;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($etudiant){
		$requete = $this->db->prepare(
			'INSERT INTO etudiant (per_num,dep_num,div_num) VALUES (:per_num, :dep_num, :div_num);');
		$requete->bindValue(':per_num',$etudiant->getEtuNum());
		$requete->bindValue(':dep_num',$etudiant->getEtuDep());
		$requete->bindValue(':div_num',$etudiant->getEtuDiv());
		$retour=$requete->execute();
			return $retour;
	}
	public function getAllEtudiant(){
		$listeEtudiant = array();
		$sql = 'SELECT per_num FROM etudiant';
		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($etudiant = $requete->fetch(PDO::FETCH_OBJ))
			$listeEtudiant[] = new Etudiant($etudiant);

		$requete->closeCursor();
		return $listeEtudiant;
	}

	public function getDepEtu ($per_num){
		$sql = "SELECT dep_nom FROM etudiant e JOIN departement d ON e.dep_num = d.dep_num WHERE per_num = $per_num";
		$requete = $this->db->prepare($sql);
		$requete->bindValue(':per_num',$per_num,PDO::PARAM_INT);
		$requete->execute();
		$etu = $requete->fetch(PDO::FETCH_OBJ);

		return $etu->dep_nom;
	}

	public function getDivEtu ($per_num){
		$sql = "SELECT dip_nom FROM etudiant e JOIN division d ON e.dep_num = d.dep_num WHERE per_num = $per_num";
		$requete = $this->db->prepare($sql);
		$requete->bindValue(':per_num',$per_num,PDO::PARAM_INT);
		$requete->execute();
		$etu = $requete->fetch(PDO::FETCH_OBJ);

		return $etu->div_nom;
	}

	public function getVilEtu ($per_num){
		$sql = "SELECT vil_nom FROM etudiant e JOIN departement d ON e.dep_num = d.dep_num JOIN ville v ON d.vil_num = v.vil_num WHERE per_num = $per_num";
		$requete = $this->db->prepare($sql);
		$requete->bindValue(':per_num',$per_num,PDO::PARAM_INT);
		$requete->execute();
		$etu = $requete->fetch(PDO::FETCH_OBJ);

		return $etu->vil_nom;
	}

	public function etuCreer($login){
		$sql = "SELECT * FROM etudiant WHERE per_num = $login";
		$requete = $this->db->prepare($sql);
		if ($requete != NULL){
			return true;
		}
		return false;
	}
	public function supprimerEtudiant($id){
		$sql = "DELETE FROM etudiant WHERE per_num = $id";
		$requete = $this->db->prepare($sql);
		$requete->execute();
	}

	public function getEtudiant ($per_num){
		$sql = "SELECT * FROM personne WHERE per_num = $per_num";
		$requete = $this->db->prepare($sql);
		$requete->bindValue(':per_num',$per_num,PDO::PARAM_INT);
		$requete->execute();
		$etu = $requete->fetch(PDO::FETCH_OBJ);
		$newEtu = new Etudiant($etu);
		return $newEtu;
	}
}
?>
