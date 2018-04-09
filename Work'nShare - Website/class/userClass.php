<?php


require "class/dataBaseClass.php";

class User extends DataBase{

	public $idUser;
	public $nameUser;
	public $surnameUser;
	public $emailUser;
	public $password;
	public $password2;


	public function __construct(){

	}

	public function deleteUser($id){
		$this->idUser = $id;

		$db = new DataBase();
		$db->connectDataBase();

		$query = $db->prepareQuery('
									UPDATE user
									SET isDeleted = 1
									WHERE idUser = '.$this->idUser.'
								');

		$db->executeQuery();


	}
	//A TERMINER
	public function updateUser($idUser, $nameUser, $surnameUser){

		echo "En cours";
		$this->idUser = $idUser;
		$db = new DataBase();
		$db->connectDataBase();
		$db->prepareQuery('
							UPDATE user
							SET
							WHERE idUSer = '.$this->idUser.'
						');
		$db->executeQuery();

	}


}


?>
