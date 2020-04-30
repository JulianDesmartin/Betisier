<?php

class Vote {
	private $cit_num;
	private $per_num;
  private $vot_valeur;

	public function __construct($valeur = array()){
		if (!empty($valeur))
		$this->affecte($valeur);
	}
	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){
			switch ($attribut){
				case 'cit_num': $this->setCitNum($valeur);
				break;
				case 'per_num': $this->setPerNum($valeur);
				break;
        case 'vot_valeur': $this->setVotValeur($valeur);
        break;
			}
		}
	}
	public function getCitNum(){
		return $this->cit_num;
	}
	public function getPerNum(){
		return $this->per_num;
	}
  public function getVotValeur(){
    return $this->vot_valeur;
  }
	public function setCitNum($id){
		$this->cit_num = $id;
	}
	public function setPerNum($num){
		$this->per_num = $num;
	}
  public function setVotValeur($valeur){
    $this->vot_valeur = $valeur;
  }
}
?>
