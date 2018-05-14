<?php
require_once "class/dataBaseClass.php";
require_once "class/messageClass.php";

class Equipment{

	private $idEquipment;
	private $nameEquipment;
	private $typeEquipment;
	private $idOpenSpace;
	private $db;
	private $error = false;
	private $success = false;
	private $listOfErrorsEvent = array();
	private $listOfSuccessEvent = array();

	public function __construct(){
		$db = new DataBase();
		$this->db = $db;
		$message = new Message();
		$this->message = $message;
	}
	private function isError(){
		if($this->error == true){
			
			$_SESSION['error'] = $this->listOfErrorsEvent;
		}
	}
	private function isSuccess(){
		if($this->success == true){
			$_SESSION['success'] = $this->listOfSuccessEvent;

		}
	}
	public function isEmpty($value, $index){
		if(empty($value) || $value == ""){
			$this->error = true;
			
			$this->listOfErrorsEquipment[] = $this->message->listOfErrorsEquipment(5);
			self::isError();

		}
		return;
	}
	public function loadEquipmentByName($name){
		$this->db->prepareQuery('SELECT * FROM equipments WHERE nameEquipment = :nameEquipment');
		$this->db->executeQuery([
			"nameEquipment" => $name
		]);
		return $this->db->fetchQuery();
	}
	public function countEquipmentByType($typeEquipment){
		$this->db->prepareQuery('SELECT COUNT(typeEquipment) FROM equipments WHERE typeEquipment = :typeEquipment');
		$this->db->executeQuery([
			"typeEquipment" => $typeEquipment
		]);
		return $this->db->fetchQuery();
	}
	public function loadTypeEquipment(){
		$this->db->prepareQuery('SELECT DISTINCT typeEquipment FROM equipments');
		$this->db->executeQuery();
		return $this->db->fetchQuery();
	}
	public function loadEquipments(){
		$this->db->prepareQuery('SELECT * FROM equipments ORDER BY idEquipment');
		$this->db->executeQuery();
		return $this->db->fetchQuery();
	}
	public function addEquipment($nameEquipment, $typeEquipment, $idOpenSpace){

		$this->nameEquipment = strtoupper($nameEquipment);
		$this->typeEquipment = $typeEquipment;
		$this->idOpenSpace = $idOpenSpace;

		$this->db->prepareQuery('
			INSERT INTO equipments(nameEquipment, typeEquipment, idOpenSpace) 
			VALUES(:nameEquipment, :typeEquipment, :idOpenSpace)');
		$this->db->executeQuery([
			"nameEquipment" => $this->nameEquipment,
			"typeEquipment" => $this->typeEquipment,
			"idOpenSpace" => $this->idOpenSpace

		]);
		$this->success = true;
			
		$this->listOfSuccessEquipment[] = $this->message->listOfErrorsEquipment(1);
		self::isSuccess();
	}
	public function deleteEquipment($id){
		$this->idEquipment = $id;
		$this->db->prepareQuery('
			DELETE FROM equipments
			WHERE idEquipment = :idEquipment
			');
		$this->db->executeQuery([
			"idEquipment" => $this->idEquipment
		]);
		$this->success = true;
			
		$this->listOfSuccessEquipment[] = $this->message->listOfErrorsEquipment(3);
		self::isSuccess();

	}
	public function updateEquipment($id, $idOpenSpace, $typeEquipment, $nameEquipment){
		$this->idEquipment = $id;
		$this->idOpenSpace = $idOpenSpace;
		$this->typeEquipment = $typeEquipment;
		$this->nameEquipment = $nameEquipment;
		$this->db->prepareQuery('
			UPDATE equipments 
			SET nameEquipment = :nameEquipment, typeEquipment = :typeEquipment, idOpenSpace = :idOpenSpace
			WHERE idEquipment = :idEquipment
			');
		$this->db->executeQuery([
			
			"nameEquipment" => $this->nameEquipment,
			"typeEquipment" => $this->typeEquipment,
			"idOpenSpace" => $this->idOpenSpace,
			"idEquipment" => $this->idEquipment
		]);

		$this->success = true;
			
		$this->listOfSuccessEquipment[] = $this->message->listOfErrorsEquipment(4);
		self::isSuccess();
	}

	public function countEquipment($idOpenSpace){
		
	}
}