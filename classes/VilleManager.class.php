<?php

class VilleManager {
	private $dbo;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($ville){
		$requete = $this->db->prepare(
			'INSERT INTO ville (vil_nom) VALUES (:vil_nom);');
		$requete->bindValue(':vil_nom',$ville->getVilNom());
		$retour=$requete->execute();
			return $retour;
	}
	public function getAllVille(){
		$listeVille = array();
		$sql = 'SELECT vil_num, vil_nom FROM ville';
		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($ville = $requete->fetch(PDO::FETCH_OBJ))
			$listeVille[] = new Ville($ville);

		$requete->closeCursor();
		return $listeVille;
	}

}
?>
