<?php

require "class/userClass.php";
class Validators extends User{
	public $indexError;
	private $listOfErrors = array(

								0 => 'Veuillez saisir tous les champs.',
								1 => 'Les mots de passe saisis ne sont pas identiques.',
								2 => 'Cet email est déjà utilisé.'

							);
	private $parameters;
	public function __construct($parameters = array()){
		$this->parameters = $parameters;
	} //->$_POST

	public function notEmpty($value){
		if(empty($value)){
			return getErrors(0);
		}
		return true;
	}
	public function setValue($name, $property){
		
	}
	public function verifyPassword($password, $password2){

		if($this->password != $this->password2){
			return getErrors(1);
		}

	}
	public function getErrors($indexError){

		return $this->listOfErrors[$indexError];
	}


}