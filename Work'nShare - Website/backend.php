<?php

require "conf.inc.php";
require "functions.php";

class Backend{

	private $surround ='p';
	public $user;
	private $cnt = 0;
	public $result;

	public function __construct(){


	}
	private function surround($html){
		return "<{$this->surround}>{$html}</$this->surround}>";
	}
	public function getUserDataFromDataBase(){

		$db = new DataBase();
		$db->connectDataBase();

		$db->prepareQuery("SELECT * FROM user WHERE isAdmin = :isAdmin");

		$db->executeQuery(['isAdmin' => 0]); //RENVOIE UNIQUEMENT TRUE
		$this->result = $db->fetchQuery();

		var_dump($this->result); // DEVRAIT RENVOYER UN TABLEAU

		while($this->result != null){

			if($this->cnt == 0){
				$this->cnt++;
				return $this->surround('<tr><th>' . $this->result[0] . '</th>');
			}else if($this->cnt > 0 && $this->cnt != 4){
				$this->cnt++;
				return $this->surround('<th>' . $this->result[0] . '</th>');
			}else if($this->cnt == 4){
				$this->cnt = 0;
				return $this->surround('<th>' . $this->result[0] . '</th></tr>');
			}
		}

	}

}


?>
