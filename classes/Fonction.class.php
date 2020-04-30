<?php

class Fonction {
	private $fon_num;
	private $fon_libelle;

	public function __construct($valeur = array()){
		if (!empty($valeur))
		$this->affecte($valeur);
	}
	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){
			switch ($attribut){
				case 'fon_num': $this->setFonNum($valeur);
				break;
				case 'fon_libelle': $this->setFonLibelle($valeur);
				break;
			}
		}
	}
	public function getFonNum(){
		return $this->fon_num;
	}
	public function getFonLibelle(){
		return $this->fon_libelle;
	}
	public function setFonNum($num){
		$this->fon_num = $num;
	}
	public function setFonLibelle($libelle){
		$this->fon_libelle = $libelle;
	}
}
?>
