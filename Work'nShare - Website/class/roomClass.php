<?php

require "class/dataBaseClass.php";
class Room{

	public $nameRoom;
	public $typeRoom;
	public $idOpenSpace;


	public function __construct(){
	}
	public function addRoom(){

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
		/*$db->prepareQuery('
			UPDATE room
			SET stateRoom = 2
			WHERE nameRoom = '.$this->nameRoom.'
			');
		$db->executeQuery();*/
	}

	public function setMaintenance($nameRoom){
		$this->nameRoom = $nameRoom;
		$db = new DataBase();
		$db->connectDataBase();
		$db->prepareQuery('
			UPDATE room
			SET stateRoom = 2
			WHERE nameRoom = '.$this->nameRoom.'
			');
		$db->executeQuery();
	}

	public function unsetMaintenance(){

	}
	public function checkRoomName($roomName){
		//$db->prepareQuery('SELECT nameRoom FROM room');
	}
}