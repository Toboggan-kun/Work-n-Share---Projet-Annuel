<?php

require_once "conf.inc.php";
require "class/dataBaseClass.php";
require "class/messageClass.php";

class Room{

	private $idRoom;
	private $nameRoom;
	private $typeRoom;
	private $idOpenSpace;
	private $db;
	public $message;
	public $listOfErrorsRoom = array();
	public $listOfSuccessRoom = array();
	public $error = false;
	public $success = false;
	private $exist = 0;

	public function __construct(){
		$db = new DataBase();
		$this->db = $db;
		$message = new Message();
		$this->message = $message;
	}
	private function isError(){
		if($this->error == true){
			
			$_SESSION['error'] = $this->listOfErrorsRoom;
		}
	}
	private function isSuccess(){
		if($this->success == true){
			$_SESSION['success'] = $this->listOfErrorsRoom;

		}
	}
	public function roomExist($roomName){

		$nameRoom = strtoupper($roomName);
		$this->db->prepareQuery('SELECT COUNT(nameRoom) FROM room WHERE nameRoom = :nameRoom');
		$this->db->executeQuery([
			"nameRoom" => $nameRoom
		]);

		$result = $this->db->fetchQuery();

		if($result[0]['COUNT(nameRoom)'] != 0){
			$this->error = true;
			
			$this->listOfErrorsRoom[] = $this->message->listOfErrorsRoom(7);
			self::isError();
		}
		return;

	}

	public function displayOpenspaces(){
		$this->db->prepareQuery("SELECT * FROM openspace ORDER BY idOpenSpace");
		$this->db->executeQuery();
		return $this->db->fetchQuery();
	}
	public function displayRooms(){
		$this->db->prepareQuery("SELECT * FROM room ORDER BY idOpenSpace");
		$this->db->executeQuery();
		return $this->db->fetchQuery();
	}
	public function displayTypeRoom(){
		$this->db->prepareQuery("SELECT DISTINCT typeRoom FROM room");
		$this->db->executeQuery();
		return $this->db->fetchQuery();
	}
	public function filterOpenspaces($idOpenSpace){
		$this->db->prepareQuery('
		SELECT 	*
		FROM 	room
		WHERE 	idOpenSpace IN(
		SELECT 	O.idOpenSpace AS idO
		FROM 	openspace O
		WHERE 	idOpenSpace = "'.$idOpenSpace.'")
								');
		$this->db->executeQuery();
		return $this->db->fetchQuery();
	}
	public function isEmpty($value, $index){
		if(empty($value) || $value == NaN){
			$this->error = true;
			
			$this->listOfErrorsRoom[] = $this->message->listOfErrorsRoom($index);
			self::isError();

		}
		return;
	}
	public function checkValueLength($min, $max, $checkValue, $index){
		if(strlen($checkValue) < $min || strlen($checkValue) > $max){
			$this->error = true;
			
			$this->listOfErrorsRoom[] = $this->message->listOfErrorsRoom($index);
			self::isError();

		}
		return;
	}

	public function addRoom($idOpenSpace, $typeRoom, $nameRoom){


		$this->idOpenSpace = $idOpenSpace;
		$this->nameRoom = strtoupper($nameRoom);
		$this->typeRoom = $typeRoom;

		$this->db->prepareQuery('
			INSERT INTO room(idOpenSpace, nameRoom, typeRoom) 
			VALUES(:idOpenSpace, :nameRoom, :typeRoom)
			');
		$this->db->executeQuery([
			"idOpenSpace" => $this->idOpenSpace,
			"typeRoom" => $this->typeRoom,
			"nameRoom" => $this->nameRoom
		]);

		$this->success = true;
			
		$this->listOfErrorsRoom[] = $this->message->listOfErrorsRoom(6);
		self::isSuccess();
	}

	public function deleteRoom($id){
		$this->idRoom = $id;
		$this->db->prepareQuery('
			DELETE FROM room
			WHERE idRoom = :idRoom
			');
		$this->db->executeQuery([
			"idRoom" => $this->idRoom
		]);
		$this->success = true;
			
		$this->listOfErrorsRoom[] = $this->message->listOfErrorsRoom(1);
		self::isSuccess();
	}
	public function updateRoom($id, $idOpenSpace, $typeRoom, $nameRoom){
		$this->idRoom = $id;
		$this->idOpenSpace = $idOpenSpace;
		$this->nameRoom = strtoupper($nameRoom);
		$this->typeRoom = $typeRoom;

		$this->db->prepareQuery('
			UPDATE room 
			SET idOpenSpace = :idOpenSpace, typeRoom = :typeRoom, nameRoom = :nameRoom 
			WHERE idRoom = :idRoom 
			');
		$this->db->executeQuery([
			
			"idOpenSpace" => $this->idOpenSpace,
			"typeRoom" => $this->typeRoom,
			"nameRoom" => $this->nameRoom,
			"idRoom" => $this->idRoom
		]);

		$this->success = true;
			
		$this->listOfErrorsRoom[] = $this->message->listOfErrorsRoom(5);
		self::isSuccess();
	}
	public function setMaintenance($nameRoom){
		$this->nameRoom = $nameRoom;

		$this->db->prepareQuery('
			UPDATE room
			SET stateRoom = 2
			WHERE nameRoom = :nameRoom
			');
		$this->db->executeQuery([
				"nameRoom" => $this->nameRoom
		]);
	}

	public function unsetMaintenance($nameRoom){

		$this->nameRoom = $nameRoom;

		$this->db->prepareQuery('
			UPDATE room
			SET stateRoom = 0
			WHERE nameRoom = :nameRoom
			');
		$this->db->executeQuery([
				"nameRoom" => $this->nameRoom
		]);

	}
	
	public function checkRoomState(){

	}
}