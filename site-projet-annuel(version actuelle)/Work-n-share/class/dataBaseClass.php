<?php


class DataBase{

	private $host = "localhost";
 	private $name = "worknshare";
 	private $user = "root";
 	private $password = "";
 	private $pdo;


 	public $result;


	public function __construct(){
		self::connectDataBase();
	}
	public function connectDataBase() {

	    try{
			$this->pdo = new PDO("mysql:host=". $this->host .";dbname=". $this->name, $this->user, $this->password);
			$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


		}catch (Exception $e){
			die("Erreur SQL : ".$e->getMessage());
		}

	    return $this->pdo;

  	}


	public function prepareQuery($query){

		return $this->result = $this->pdo->prepare($query);
  	}

	public function executeQuery($parameters = array()){

		return $this->result->execute($parameters);
	}

	public function fetchQuery(){

		return $this->result->fetchAll();
	}

	public function lastInsertId(){
		return $this->pdo->lastInsertId();
	}

}


?>
