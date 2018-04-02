<?php

require "class/dataBaseClass.php";

class Room{

	public $nameRoom;
	public $typeRoom;
	public $idOpenSpace;


	public function __construct(){
	}
	public function addRoom($idOpenSpace, $typeRoom, $nameRoom){
		$this->idOpenSpace = $idOpenSpace;
		$this->nameRoom = $nameRoom;
		$this->typeRoom = $typeRoom;
		$db = new DataBase();
		$db->connectDataBase();
		$db->prepareQuery('
			INSERT INTO room(idOpenSpace, nameRoom, typeRoom) 
			VALUES(:idOpenSpace, :nameRoom, :typeRoom)
			');
		$db->executeQuery([
			"idOpenSpace" => $this->idOpenSpace,
			"typeRoom" => $this->typeRoom,
			"nameRoom" => $this->nameRoom
		]);
	}

	public function deleteRoom($nameRoom){
		$this->nameRoom = $nameRoom;
		$db = new DataBase();
		$db->connectDataBase();
		$db->prepareQuery('
			DELETE FROM room
			WHERE nameRoom = :nameRoom
			');
		$db->executeQuery([
				"nameRoom" => $this->nameRoom
		]);
	}

	public function setMaintenance($nameRoom){
		$this->nameRoom = $nameRoom;

		$db = new DataBase();
		$db->connectDataBase();
		$db->prepareQuery('
			UPDATE room
			SET stateRoom = 2
			WHERE nameRoom = :nameRoom
			');
		$db->executeQuery([
				"nameRoom" => $this->nameRoom
		]);
	}

	public function unsetMaintenance($nameRoom){

		$this->nameRoom = $nameRoom;

		$db = new DataBase();
		$db->connectDataBase();
		$db->prepareQuery('
			UPDATE room
			SET stateRoom = 0
			WHERE nameRoom = :nameRoom
			');
		$db->executeQuery([
				"nameRoom" => $this->nameRoom
		]);

	}
	public function checkRoomName($roomName){
		$this->nameRoom = $roomName;
		$db = new DataBase();
		$db->prepareQuery('SELECT COUNT(*) FROM room WHERE nameRoom = :nameRoom');
		$db->executeQuery([
			"nameRoom" => $this->nameRoom
		]);
		return $value = $db->fetchQuery();
	}
	public function checkRoomState(){

	}
}