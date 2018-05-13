<?php

require "class/dataBaseClass.php";
require "class/messageClass.php";
class Menu{

	private $nameMenu;
	private $starter;
	private $dish;
	private $dessert;
	private $quantity;
	private $isMainMenu;
	public $message;
	public $listOfErrorsMenu = array();
	public $listOfSuccessMenu = array();
	public $error = false;
	public $success = false;

	public function __construct(){

		$message = new Message();
		$this->message = $message;


	}
	private function isError(){
		if($this->error == true){
			
			$_SESSION['error'] = $this->listOfErrorsMenu;
		}
	}
	private function isSuccess(){
		if($this->success == true){
			
			$_SESSION['success'] = $this->listOfSuccessMenu;

		}
	}
	public function addMenu($name, $starter, $dish, $dessert, $quantity, $isMainMenu){
		
		$this->nameMenu = $name;
		$this->starter = $starter;
		$this->dish = $dish;
		$this->dessert = $dessert;
		$this->quantity = $quantity;
		$this->isMainMenu = $isMainMenu;

		if($this->isMainMenu == 1){ //SI LE MENU DOIT ETRE DEFINI COMME MENU DU JOUR
			self::changeStateMenu(); //CHANGE LE STATUT DU MENU ACTUEL SI IL Y EN A POUR LAISSER PLACE AU NOUVEAU MENU
		}
		if($this->isMainMenu == 1 || $this->isMainMenu == 0){
			$db = new DataBase();
			$db->prepareQuery('
				INSERT INTO menu(nameMenu, starter, dish, dessert, quantityMenu, stateMenu) 
				VALUES(:nameMenu, :starter, :dish, :dessert, :quantityMenu, :stateMenu)');
			$db->executeQuery([

				"nameMenu" => $this->nameMenu,
				"starter" => $this->starter,
				"dish" => $this->dish,
				"dessert" => $this->dessert,
				"quantityMenu" => $this->quantity,
				"stateMenu" => $this->isMainMenu

			]);
			
			if($this->isMainMenu == 1){
				$this->success = true;
				
				$this->listOfSuccessMenu[] = $this->message->listOfErrorsMenu(7);
				self::isSuccess();

			}
			$this->success = true;
			
			$this->listOfSuccessMenu[] = $this->message->listOfErrorsMenu(6);
			self::isSuccess();


		}else{
			$this->error = true;
			
			$this->listOfErrorsMenu[] = $this->message->listOfErrorsMenu(9);
			self::isError();

		}
		

		

	}
	public function checkValueLength($min, $max, $checkValue, $index){
		if(strlen($checkValue) < $min || strlen($checkValue) > $max){
			$this->error = true;
			
			$this->listOfErrorsMenu[] = $this->message->listOfErrorsMenu($index);
			self::isError();

		}
		return $this->error;
	}

	public function checkQuantityValue($value, $index){
		intval($value);
		if($value < 1 || $value > 100){
			$this->error = true;
			
			$this->listOfErrorsMenu[] = $this->message->listOfErrorsMenu($index);
			self::isError();


		}

		return $this->error;
	}
	private function changeStateMenu(){ //CHANGE LE STATUT DU MENU: MENU DU JOUR OU NON
		$db = new DataBase();
		$db->prepareQuery('UPDATE menu SET stateMenu = 0 WHERE stateMenu = 1');
		$db->executeQuery();

	}

	public function countMenu(){
		$db = new DataBase();
		$db->prepareQuery('SELECT COUNT(idMenu) FROM menu');
		$db->executeQuery();
		$result = $db->fetchQuery();

		return $result;
	}

	public function ifExist($name){

		if(strlen($name) == 0){
			$this->error = false;
		}else{
			$db = new DataBase();
			$db->prepareQuery('SELECT COUNT(nameMenu) FROM menu WHERE nameMenu = :nameMenu');
			$db->executeQuery([
				"nameMenu" =>$name
			]);

			$result = $db->fetchQuery();
			var_dump($result);
			if($result[0]['COUNT(nameMenu)'] != 0){
				$this->error = true;
				
				$this->listOfErrorsMenu[] = $this->message->listOfErrorsMenu(8);
				self::isError();
			}
		
		}
		return $this->error;


	}
	public function loadMenu($option){
		$db = new DataBase();
		if($option == 0){
			$db->prepareQuery('SELECT * FROM menu');
		}else if($option == 1){
			$db->prepareQuery('SELECT * FROM menu WHERE stateMenu = 1');
		}else{
			return true; //OPTION INVALIDE
		}
		
		$db->executeQuery();

		$result = $db->fetchQuery();

		return $result;
	}


	public function deleteMenu($name){
		$this->nameMenu = $name;
		$db = new DataBase();
		$db->prepareQuery('DELETE FROM menu WHERE nameMenu = :nameMenu');
		$db->executeQuery([
			"nameMenu" => $this->nameMenu
		]);

		$this->success = true;
		
		$this->listOfSuccessMenu[] = $this->message->listOfErrorsMenu(10);
		self::isSuccess();
	}
}