<?php

class CitationManager {
	private $dbo;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($citation){
		$requete = $this->db->prepare(
			'INSERT INTO citation (per_num, per_num_etu, cit_date, cit_libelle) VALUES (:per_num, :per_num_etu, :cit_date, :cit_libelle);');
		$requete->bindValue(':per_num',$citation->getPerNumCit());
		$requete->bindValue(':per_num_etu',$citation->getPerNumEtu());
		$requete->bindValue(':cit_date',$citation->getCitDate());
		$requete->bindValue(':cit_libelle',$citation->getCitLib());
		$retour=$requete->execute();
			return $retour;
	}

	public function getAllCitationValideV2(){
		$listeCitation = array();
		$sql = 'SELECT per_num,cit_num,cit_libelle,cit_date FROM citation
							WHERE cit_valide=1
							AND cit_date_valide is not null';
		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($citation = $requete->fetch(PDO::FETCH_OBJ))
			$listeCitation[] = new Citation($citation);

		$requete->closeCursor();
		return $listeCitation;
	}

	public function getCitationWithParam($prof,$date,$note){
		$listeCitation = array();
		$sql = "SELECT per_num,cit_num,cit_libelle,cit_date FROM citation c, vote v
							WHERE c.cit_num = v.cit_num
							AND cit_valide=1
							AND cit_date_valide is not null";
		if ($prof != ""){
			$sql .=" AND c.per_num = $prof";
		}
		if ($date != null){
			$sql .=" AND cit_date = $date";
		}
		if ($note != null){
			$sql .=" GROUP BY per_num,cit_num,cit_libelle,cit_date HAVING AVG(vot_valeur) = $note";
		}
		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($citation = $requete->fetch(PDO::FETCH_OBJ))
			$listeCitation[] = new Citation($citation);

		$requete->closeCursor();
		return $listeCitation;
	}

}
?>
