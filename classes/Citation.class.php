<?php

class Citation {
	private $cit_num;
	private $per_num;
	private $per_num_valide;
	private $per_num_etu;
	private $cit_libelle;
	private $cit_date;
	private $cit_valide;
	private $cit_date_valide;
	private $cit_date_depo;


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
				case 'per_num_valide': $this->setPerNumValide($valeur);
				break;
				case 'per_num_etu': $this->setPerNumEtu($valeur);
				break;
				case 'cit_libelle': $this->setCitLib($valeur);
				break;
				case 'cit_date': $this->setCitDate($valeur);
				break;
				case 'cit_valide': $this->setCitValide($valeur);
				break;
				case 'cit_date_valide': $this->setCitDateValide($valeur);
				break;
				case 'cit_date_depo': $this->setCitDateDepo($valeur);
				break;
			}
		}
	}
	public function getCitNum(){
		return $this->cit_num;
	}
	public function getPerNumCit(){
		return $this->per_num;
	}
	public function getPerNumValide(){
		return $this->per_num_valide;
	}
	public function getPerNumEtu(){
		return $this->per_num_etu;
	}
	public function getCitLib(){
		return $this->cit_libelle;
	}
	public function getCitDate(){
		return $this->cit_date;
	}
	public function getCitValide(){
		return $this->cit_valide;
	}
	public function getCitDateValide(){
		return $this->cit_date_valide;
	}
	public function getCitDateDepo(){
		return $this->cit_date_depo;
	}

	public function setCitNum($num){
		$this->cit_num = $num;
	}
	public function setPerNum($num){
		$this->per_num = $num;
	}
	public function setPerNumValide($num){
		$this->per_num_valide = $num;
	}
	public function setPerNumEtu($num){
		$this->per_num_etu = $num;
	}
	public function setCitLib($libelle){
		$this->cit_libelle = $libelle;
	}
	public function setCitDate($date){
		$this->cit_date = $date;
	}
	public function setCitValide($valide){
		$this->cit_valide = $valide;
	}
	public function setCitDateValide($date){
		$this->cit_date_valide = $date;
	}
	public function setCitDateDepo($date){
		$this->cit_date_depo = $date;
	}

}
?>
