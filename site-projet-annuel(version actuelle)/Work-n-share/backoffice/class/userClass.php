<?php

require_once "conf.inc.php";
require "class/dataBaseClass.php";
require "class/messageClass.php";

class User{

	private $idUser;
	private $nameUser;
	private $surnameUser;
	private $emailUser;
	private $password;
	private $password2;
	private $message;
	private $db;
	private $subscription;
	public $listOfErrorsUser = array();
	public $listOfSuccessUser = array();
	public $error = false;
	public $success = false;


	public function __construct(){
		$db = new DataBase();
		$this->db = $db;
		$message = new Message();
		$this->message = $message;
	}
	private function isError(){
		if($this->error == true){
			
			$_SESSION['error'] = $this->listOfErrorsUser;
		}
	}
	private function isSuccess(){
		if($this->success == true){
			
			$_SESSION['success'] = $this->listOfSuccessUser;
		}
	}
	public function deleteUser($id){

		$this->idUser = $id;
		$query = $this->db->prepareQuery('
									UPDATE user
									SET isDeleted = 1
									WHERE idUser = '.$this->idUser.'
								');

		$this->db->executeQuery();

		$this->success = true;
		$this->listOfSuccessUser[] = $this->message->listOfErrorsUser(1);
		self::isSuccess();


	}
	//A TERMINER
	public function updateUser($idUser, $nameUser, $surnameUser){


		$this->idUser = $idUser;

		$this->db->prepareQuery('
							UPDATE user
							SET
							WHERE idUSer = '.$this->idUser.'
						');
		$this->db->executeQuery();

	}

	public function loadSubscription($sub){

		$this->db->prepareQuery("SELECT * FROM subscription WHERE nameSubscription = :nameSubscription");

		$this->db->executeQuery	([
			"nameSubscription" => $sub
		 									]);
		return $this->db->fetchQuery();
	}
	private function ifUserHaveBooking(){

		$this->db->prepareQuery('SELECT idBooking FROM booking WHERE idUser = :idUser');
		$this->db->executeQuery([
			"idUser" => $this->idUser
		]);

		$result = $this->db->fetchQuery();
		if($result == null){
			$this->error = true;
			$this->listOfErrorsUser[] = $this->message->listOfErrorsUser($index);
			self::isError();
		}

		return;
	}
	public function convertIntSubtoString($sub_int){

		switch ($sub_int) {
			case '0':
				$this->subscription = "Sans abonnement";
				break;
			case '1':
				$this->subscription = "Abonnement simple";
				break;
			case '2':
				$this->subscription = "Abonnement résident";
				break;
			
			default:
				
				break;
		}
		return $this->subscription;

	}
	public function loadUsers($option){
		$this->db->prepareQuery("SELECT * FROM user WHERE isAdmin = :isAdmin AND isDeleted = :isDeleted");

		$this->db->executeQuery	([	'isAdmin' => 0,
								'isDeleted' => $option
		 									]);
		return $this->db->fetchQuery();
	}
	public function laodUserById($id){
		$this->db->prepareQuery("SELECT * FROM user WHERE idUser = :idUser");

		$this->db->executeQuery	([
			"idUser" => $id
		 									]);
		return $this->db->fetchQuery();
	}

	public function unsuspendUser($id){
		$this->idUser = $id;
		$query = $this->db->prepareQuery('
									UPDATE user
									SET isDeleted = 0
									WHERE idUser = '.$this->idUser.'
								');

		$this->db->executeQuery();

		$this->success = true;
		$this->listOfSuccessUser[] = $this->message->listOfErrorsUser(2);
		self::isSuccess();
	}
	public function checkIsInt($value){
		if(!is_int($value)){
			$this->error = true;
			$this->listOfErrorsUser[] = $this->message->listOfErrorsUser(4); 
			self::isError();

		}
		return $this->error;
	}
	public function checkCardNumber($value){

		if(strlen($value) == 16 && ctype_digit($value)){ //SI FORMAT 0000000000000000
			$this->error = false;
		}else{
			$this->error = true;
			$this->listOfErrorsBooking[] = $this->message->listOfErrorsBooking(3);
		}
		self::isError();
		return $this->error;
	}
	public function checkCardSecurity($value){
		if(strlen($value) == 3 && ctype_digit($value)){
			$this->error = false;

		}else{
			$this->error = true;
			$this->listOfErrorsUser[] = $this->message->listOfErrorsUser(4);

		}
		self::isError();
		return $this->error;
	}
	public function checkCardMonth($month, $year){
		$currentYear = date("Y", strtotime($_SESSION['currentDateEN']));
		$currentMonth = date("m", strtotime($_SESSION["currentDateEN"])); //RECUPERATION DU MOIS D'AUJOURD'HUI
		if($year == $currentYear && strlen($month) == 2 && ctype_digit($month) && ($currentMonth < $month) && ($month >= 1 && $month <= 12)){

			$this->error = false;
		}else if($year > $currentYear && strlen($month) == 2 && ctype_digit($month) && ($month >= 1 && $month <= 12)){
			$this->error = false;
		}
		else{
			$this->error = true;
			$this->listOfErrorsUser[] = $this->message->listOfErrorsUser(5);
		}
		self::isError();
		return $this->error;
	}
	public function checkCardYear($value){
		//EN FRANCE, LA VALIDITE D'UNE CARTE BLEUE DURE EN MOYENNE 3 ANS
		//L'UTILISATEUR NE POURRA PAS AVOIR UNE CARTE QUI EXPIRE PLUS DE 3 ANS A PARTIR DE CETTE ANNEE
		$currentYear = date("Y", strtotime($_SESSION['currentDateEN']));
		if(strlen($value) == 4 && ctype_digit($value) && ($currentYear <= $value) && ($value >= $currentYear && $value <= $currentYear+3)){
			$this->error = false;
		}else{
			$this->error = true;
			$this->listOfErrorsUser[] = $this->message->listOfErrorsUser(5);
		}
		self::isError();
		return $this->error;
	}




}


?>
