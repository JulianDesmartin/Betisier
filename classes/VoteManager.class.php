<?php

class VoteManager {
	private $dbo;

	public function __construct($db){
		$this->db = $db;
	}
	public function add($vote){
		$requete = $this->db->prepare(
			'INSERT INTO vote (cit_num, per_num, vot_valeur) VALUES (:cit_num, :per_num, :vot_valeur);');
		$requete->bindValue(':cit_num',$vote->getCitNum());
		$requete->bindValue(':per_num',$vote->getPerNum());
    $requete->bindValue(':vot_valeur',$vote->getVotValeur());
		$retour=$requete->execute();
			return $retour;
	}
	public function getAllVote(){
		$listeVote = array();
		$sql = 'SELECT * FROM vote';
		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($vote = $requete->fetch(PDO::FETCH_OBJ))
			$listeVote[] = new Vote($vote);

		$requete->closeCursor();
		return $listeVote;
	}

  public function getMoyenneVoteCitation($num_cit){
    $sql = "SELECT avg(vot_valeur) as cit_moy FROM vote WHERE cit_num = '$num_cit'";
    $requete = $this->db->prepare($sql);
    $requete->bindValue(':cit_num',$num_cit,PDO::PARAM_INT);
    $requete->execute();
    $citation = $requete->fetch(PDO::FETCH_OBJ);

    return $citation->cit_moy;
  }


	public function aVoter($citnum,$id){
		$listeVote = array();
		$sql = "SELECT * FROM vote WHERE per_num = $id AND cit_num = $citnum";
		$requete = $this->db->prepare($sql);
		$requete->execute();

		while ($vote = $requete->fetch(PDO::FETCH_OBJ))
			$listeVote[] = new Vote($vote);

		return $listeVote;
  }

}
?>
