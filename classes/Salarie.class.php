<?php

class Salarie {
	private $per_num;
	private $sal_telprof;
	private $fon_num;

	public function __construct($valeur = array()){
		if (!empty($valeur))
		$this->affecte($valeur);
	}
	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){
			switch ($attribut){
				case 'per_num': $this->setSalNum($valeur);
				break;
				case 'sal_telprof': $this->setSalTelPro($valeur);
				break;
				case 'fon_num': $this->setSalFonction($valeur);
				break;
			}
		}
	}
	public function getSalNum(){
		return $this->per_num;
	}
	public function getSalTelPro(){
		return $this->sal_telprof;
	}
	public function getSalFonction(){
		return $this->fon_num;
	}

	public function setSalNum($num){
		$this->per_num = $num;
	}
	public function setSalTelPro($tel){
		$this->sal_telprof = $tel;
	}
	public function setSalFonction($fonction){
		$this->fon_num = $fonction;
	}

}
?>
