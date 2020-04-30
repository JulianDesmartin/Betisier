<?php

class Personne {
	private $per_num;
	private $per_nom;
	private $per_prenom;
	private $per_tel;
	private $per_mail;
	private $per_admin;
	private $per_login;
	private $per_pwd;

	public function __construct($valeur = array()){
		if (!empty($valeur))
		$this->affecte($valeur);
	}
	public function affecte($donnees){
		foreach ($donnees as $attribut =>$valeur){
			switch ($attribut){
				case 'per_num': $this->setPerNum($valeur);
				break;
				case 'per_nom': $this->setPerNom($valeur);
				break;
				case 'per_prenom': $this->setPerPre($valeur);
				break;
				case 'per_tel': $this->setPerTel($valeur);
				break;
				case 'per_mail': $this->setPerMail($valeur);
				break;
				case 'per_admin': $this->setPerAdmin();
				break;
				case 'per_login': $this->setPerLogin($valeur);
				break;
				case 'per_pwd': $this->setPerPwd($valeur);
				break;
			}
		}
	}
	public function getPerNum(){
		return $this->per_num;
	}
	public function getPerNom(){
		return $this->per_nom;
	}
	public function getPerPre(){
		return $this->per_prenom;
	}
	public function getPerTel(){
		return $this->per_tel;
	}
	public function getPerMail(){
		return $this->per_mail;
	}
	public function getPerAdmin(){
		return $this->per_admin;
	}
	public function getPerLogin(){
		return $this->per_login;
	}
	public function getPerPwd(){
		return $this->per_pwd;
	}

	public function setPerNum($num){
		$this->per_num = $num;
	}
	public function setPerNom($nom){
		$this->per_nom = $nom;
	}
	public function setPerPre($prenom){
		$this->per_prenom = $prenom;
	}
	public function setPerTel($tel){
		$this->per_tel = $tel;
	}
	public function setPerMail($mail){
		$this->per_mail = $mail;
	}
	public function setPerAdmin(){
		$this->per_admin = '0';
	}
	public function setPerLogin($login){
		$this->per_login = $login;
	}
	public function setPerPwd($pwd){
		$salt = "48@!alsd";
		$pwd_crypte = sha1(sha1($pwd).$salt);
		$this->per_pwd = $pwd_crypte;
	}


}
?>
