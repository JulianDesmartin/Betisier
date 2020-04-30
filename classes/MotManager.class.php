<?php

class MotManager {
	private $dbo;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($mot){
		$requete = $this->db->prepare(
			'INSERT INTO mot (mot_id, mot_interdit) VALUES (:mot_id, :mot_interdit);');
		$requete->bindValue(':mot_id',$mot->getMotId());
		$requete->bindValue(':mot_interdit',$mot->getMotInterdit());
		$retour=$requete->execute();
			return $retour;
	}
	public function getAllMot(){
		$listeMot = array();
		$sql = 'SELECT mot_id,mot_interdit FROM mot';
		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($mot = $requete->fetch(PDO::FETCH_OBJ))
			$listeMot[] = new Mot($mot);

		$requete->closeCursor();
		return $listeMot;
	}
}
?>
