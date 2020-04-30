<?php

class Ville {
	private $vil_num;
	private $vil_nom;

	public function __construct($valeur = array()){
		if (!empty($valeur))
		$this->affecte($valeur);
	}
	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){
			switch ($attribut){
				case 'vil_num': $this->setVilNum($valeur);
				break;
				case 'vil_nom': $this->setVilNom($valeur);
				break;
			}
		}
	}
	public function getVilNum(){
		return $this->vil_num;
	}
	public function getVilNom(){
		return $this->vil_nom;
	}
	public function setVilNum($num){
		$this->vil_num = $num;
	}
	public function setVilNom($nom){
		$this->vil_nom = $nom;
	}
}
?>
