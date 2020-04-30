<?php

class Etudiant {
	private $per_num;
	private $dep_num;
	private $div_num;


	public function __construct($valeur = array()){
		if (!empty($valeur))
		$this->affecte($valeur);
	}
	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){
			switch ($attribut){
				case 'per_num': $this->setEtuNum($valeur);
				break;
				case 'dep_num': $this->setEtuDep($valeur);
				break;
				case 'div_num': $this->setEtuDiv($valeur);
				break;
			}
		}
	}
	public function getEtuNum(){
		return $this->per_num;
	}
	public function getEtuDiv(){
		return $this->div_num;
	}
	public function getEtuDep(){
		return $this->dep_num;
	}

	public function setEtuNum($num){
		$this->per_num = $num;
	}
	public function setEtuDiv($div){
		$this->div_num = $div;
	}
	public function setEtuDep($dep){
		$this->dep_num = $dep;
	}


}
?>
