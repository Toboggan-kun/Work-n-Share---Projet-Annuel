<?php
require_once "conf.inc.php";
require "class/dataBaseClass.php";
require "class/messageClass.php";
class Event{

	private $title;
	private $address;
	private $postalCode;
	private $city;
	private $date;
	private $time;
	private $description;
	private $idOpenspace;
	public $message;
	public $listOfErrorsEvent = array();
	public $listOfSuccessEvent = array();
	public $error = false; //PAR DEFAUT PAS D'ERREURS, SI true = ERREURS
	public $success = false;
	private $db;


	public function __construct(){
		$db = new DataBase();
		$message = new Message();
		$this->message = $message;
		$this->db = $db;
	}
	public function isEmpty(){

		$this->db->prepareQuery("SELECT COUNT(*) AS numberEvents FROM event");
		$this->db->executeQuery();
		$count = $this->db->fetchQuery();
		return $count;

	}
	public function isNull($value, $intError){
		if($value == null || strlen($value) < 1){

			$this->error = true;

			$this->listOfErrorsEvent[] = $this->message->listOfErrorsEvent($intError);
			self::isError();

		}else{
			$this->error = false;
			self::isError();
		}
		return $this->error;
		
	}
	public function verifyEvent($date, $time){
		$this->date = $date;
		$this->time = $time;


		if(strtotime($this->date) >= strtotime($_SESSION['currentDateEN'])){ //COMPARER LA DATE D'AUJOURD'HUI ET LA DATE SAISIE PAR L'UTILISATEUR FORMAT YYYY-MM-DD

			if(strtotime($_SESSION['currentDateEN']) > strtotime($this->date) && strtotime($_SESSION['currentTime']) > strtotime($this->time)){ //COMPARER L'HEURE ACTUELLE AVEC L'HEURE PASSEE PAR LA SAISIE
				$this->error = true;

				$this->listOfErrorsEvent[] = $this->message->listOfErrorsEvent(4);
				self::isError();

			}else{
				$this->error = false;
				self::isError();
			}
		}else{
			$this->error = true;
			$this->listOfErrorsEvent[] = $this->message->listOfErrorsEvent(3);
			self::isError();
		}
		
		return $this->error;

	}
	public function isError(){
		if($this->error == true){

			$_SESSION['error'] = $this->listOfErrorsEvent;

		}
	}
	private function isSuccess(){
		if($this->success == true){

			$_SESSION['success'] = $this->listOfSuccessEvent;

		}
	}

	public function convertIntOpenspaceToString($id){
		switch ($id) {
			case '1':
				$this->idOpenspace = "Bastille";
				break;
			case '2':
				$this->idOpenspace = "République";
				break;
			case '3':
				$this->idOpenspace = "Odéon";
				break;
			case '4':
				$this->idOpenspace = "Place d'Italie";
				break;
			case '5':
				$this->idOpenspace = "Ternes";
				break;
			case '6':
				$this->idOpenspace = "Beaubourg";
				break;
			default:
				break;

			
		}
	
		return $this->idOpenspace;
	}
	public function ifEventExist($date, $idOpenspace){

		if($idOpenspace == "Bastille"){
			$idOpenspace = 1;
		}else if($idOpenspace == "République"){
			$idOpenspace = 2;
		}else if($idOpenspace == "Odéon"){
			$idOpenspace = 3;
		}else if($idOpenspace == "Place d'Italie"){
			$idOpenspace = 4;
		}else if($idOpenspace == "Ternes"){
			$idOpenspace = 5;
		}else if($idOpenspace == "Beaubourg"){
			$idOpenspace = 6;
		}else{
			return;
		}

		$this->db->prepareQuery('SELECT COUNT(idEvent) FROM event WHERE dateEvent = :dateEvent AND idOpenSpace = :idOpenSpace');
		$this->db->executeQuery([
			"dateEvent" => $date,
			"idOpenSpace" => $idOpenspace
		]);

		$result = $this->db->fetchQuery();

		if($result[0]['COUNT(idEvent)'] != 0){
			$this->error = true;
			$this->listOfErrorsEvent[] = $this->message->listOfErrorsEvent(15);
			self::isError();
		}else{
			$this->error = false;
			self::isError();
		}
		return $this->error;
	}
	public function addEvent($title, $address, $postalCode, $city, $date, $time, $description, $idOpenspace){
		$this->title = ucfirst(strtolower($title));
		if(strlen($address) == 0){
			$this->address = null;
		}else{
			$this->address = ucfirst(strtolower($address));
		}
		if(strlen($city) == 0){
			$this->city = null;
		}else{
			$this->city = ucfirst(strtolower($city));
		}
		
		$this->postalCode = $postalCode;
		
		$this->date = $date;
		$this->time = $time;
		$this->description = ucfirst(strtolower($description));

		if($idOpenspace == "Bastille"){
			$this->idOpenspace = 1;
		}else if($idOpenspace == "République"){
			$this->idOpenspace = 2;
		}else if($idOpenspace == "Odéon"){
			$this->idOpenspace = 3;
		}else if($idOpenspace == "Place d'Italie"){
			$this->idOpenspace = 4;
		}else if($idOpenspace == "Ternes"){
			$this->idOpenspace = 5;
		}else if($idOpenspace == "Beaubourg"){
			$this->idOpenspace = 6;
		}else{
			$this->idOpenspace = null;
		}
		
		$this->db->prepareQuery('INSERT INTO event(
			title,
			dateCreationEvent,
			dateEvent,
			hourEvent,
			descriptionEvent,
			addressEvent,
			postalCodeEvent,
			cityEvent,
			idOpenSpace
			)

			VALUES(:title, :dateCreationEvent, :dateEvent, :hourEvent, :descriptionEvent, :addressEvent, :postalCodeEvent, :cityEvent, :idOpenSpace)

			');

		$this->db->executeQuery([
			"title" => $this->title,
			"dateCreationEvent" => $_SESSION['currentDateEN'],
			"dateEvent" => $this->date,
			"hourEvent" => $this->time,
			"descriptionEvent" => $this->description,
			"addressEvent" => $this->address,
			"postalCodeEvent" => $this->postalCode,
			"cityEvent" => $this->city,
			"idOpenSpace" => $this->idOpenspace
		]);

		$this->success = true;

		$this->listOfSuccessEvent[] = $this->message->listOfErrorsMenu(6);
		self::isSuccess();



	}
	public function checkValueLength($min, $max, $checkValue, $index){
		if(strlen($checkValue) < $min || strlen($checkValue) > $max){
			$this->error = true;

			$this->listOfErrorsEvent[] = $this->message->listOfErrorsEvent($index);
			self::isError();

		}
		return $this->error;
	}
	public function titleExist($title){

		$this->db->prepareQuery('SELECT COUNT(title) FROM event WHERE title = :title');
		$this->db->executeQuery([
			"title" => $title
		]);

		$result = $this->db->fetchQuery();

		if($result[0]['COUNT(title)'] != 0){
			$this->error = true;
			$this->listOfErrorsEvent[] = $this->message->listOfErrorsEvent(1);
			self::isError();
		}else{
			$this->error = false;
			self::isError();
		}
		return $this->error;

	}

	public function deleteEvent($id){
		$this->db->prepareQuery('DELETE FROM event WHERE idEvent = :idEvent');
		$this->db->executeQuery([
			"idEvent" => $id
		]);
		$this->success = true;

		$this->listOfSuccessEvent[] = $this->message->listOfErrorsEvent(7);
		self::isSuccess();
		return $this->error;

	}

	public function modifyEvent(){

	}
}
