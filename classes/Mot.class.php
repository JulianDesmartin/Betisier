<?php

class Mot {
	private $mot_id;
	private $mot_interdit;

	public function __construct($valeur = array()){
		if (!empty($valeur))
		$this->affecte($valeur);
	}
	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){
			switch ($attribut){
				case 'mot_id': $this->setMotId($valeur);
				break;
				case 'mot_interdit': $this->setMotInterdit($valeur);
				break;
			}
		}
	}
	public function getMotId(){
		return $this->mot_id;
	}
	public function getMotInterdit(){
		return $this->mot_interdit;
	}
	public function setMotId($id){
		$this->mot_id = $id;
	}
	public function setMotInterdit($motInterdit){
		$this->mot_interdit = $motInterdit;
	}
}
?>
