<?php

class SalarieManager {
	private $dbo;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($salarie){
		$requete = $this->db->prepare(
			'INSERT INTO salarie (per_num,sal_telprof,fon_num) VALUES (:per_num,:sal_telprof,:fon_num);');
		$requete->bindValue(':per_num',$salarie->getSalNum());
		$requete->bindValue(':sal_telprof',$salarie->getSalTelPro());
		$requete->bindValue(':fon_num',$salarie->getSalFonction());
		$retour=$requete->execute();
			return $retour;
	}
	public function getAllSalarie(){
		$listeSalarie = array();
		$sql = 'SELECT per_num,sal_telprof,fon_num FROM salarie';
		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($salarie = $requete->fetch(PDO::FETCH_OBJ))
			$listeSalarie[] = new Salarie($salarie);

		$requete->closeCursor();
		return $listeSalarie;
	}

	public function getTelPro ($per_num){
		$sql = "SELECT sal_telprof FROM salarie WHERE per_num = $per_num";
		$requete = $this->db->prepare($sql);
		$requete->bindValue(':per_num',$per_num,PDO::PARAM_INT);
		$requete->execute();
		$sal = $requete->fetch(PDO::FETCH_OBJ);

		return $sal->sal_telprof;
	}

	public function getFonctionSal ($per_num){
		$sql = "SELECT fon_libelle FROM salarie s JOIN fonction f ON s.fon_num = f.fon_num WHERE per_num = $per_num";
		$requete = $this->db->prepare($sql);
		$requete->bindValue(':per_num',$per_num,PDO::PARAM_INT);
		$requete->execute();
		$sal = $requete->fetch(PDO::FETCH_OBJ);

		return $sal->fon_libelle;
	}

	public function supprimerSalarie($id){
		$sql = "DELETE FROM salarie WHERE per_num = $id";
		$requete = $this->db->prepare($sql);
		$requete->execute();
	}
}
?>
