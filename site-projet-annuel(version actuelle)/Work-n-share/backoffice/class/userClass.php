<?php

require_once "conf.inc.php";
require_once "class/dataBaseClass.php";
require_once "class/messageClass.php";

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

	public function addCard($card_number, $card_security, $card_month, $card_year, $idUser){
		var_dump($card_number);
		var_dump($card_security);

		$card_expiration_date = $card_year."-".$card_month;

		$card_expiration_date = date("Y-m-d", strtotime($card_expiration_date));
	
		$this->db->prepareQuery("INSERT INTO card(card_number, card_security, card_expiration_date, idUser) VALUES(:card_number, :card_security, :card_expiration_date, :idUser)");

		$this->db->executeQuery	([
			"card_number" => $card_number,
			"card_security" => $card_security,
			"card_expiration_date" => $card_expiration_date,
			"idUser" => $idUser
		 									]);
		

	}
	public function addSubscription($idUser, $subscription, $engagement){
		$subscription_date = $_SESSION['currentDateEN'];
		/*
			0 = SANS ABONNEMENT
			1 = ABONNEMENT SIMPLE SANS ENGAGEMENT
			2 = ABONNEMENT SIMPLE AVEC ENGAGEMENT
			3 = ABONNEMENT RESIDENT SANS ENGAGEMENT
			4 = ABONNEMENT RESIDENT AVEC ENGAGEMENT
		*/
		$value;

		if($subscription == "Sans abonnement"){
			$value = 0;
		}else if($subscription == "Abonnement simple" && $engagement == 0){
			$value = 1;
			var_dump($value);
		}else if($subscription == "Abonnement simple" && $engagement == 1){
			$value = 2;
		}else if($subscription == "Abonnement résident" && $engagement == 0){
			$value = 3;
		}else if($subscription == "Abonnement résident" && $engagement == 1){
			$value = 4;
		}
		$this->db->prepareQuery('
							UPDATE user
							SET subscription = :subscription, subscriptionDate = :subscriptionDate
							WHERE idUser = :idUser
						');
		$this->db->executeQuery([
			"subscription" => $value,
			"idUser" => $idUser,
			"subscriptionDate" => $_SESSION['currentDateEN']
		]);

	}




}


?>
