<?php

require "class/dataBaseClass.php";
require "class/messageClass.php";

class Openspace{

	private $openHour;
	private $closeHour;
	private $idOpenSpace;
	private $db;
	private $day;

	public function __construct(){
		$db = new DataBase();
		$this->db = $db;
	}

	public function loadOpenspaces(){
		$this->db->prepareQuery('SELECT * FROM openspace ORDER BY idOpenSpace');
		$this->db->executeQuery();
		return $this->db->fetchQuery();
	}

	public function loadSchedulesById($id){

		$this->db->prepareQuery('SELECT day, openHour, closeHour FROM schedule WHERE idOpenSpace = :idOpenSpace ORDER BY idOpenSpace');
		$this->db->executeQuery([
			"idOpenSpace" => $id
		]);
		return $this->db->fetchQuery();

		
	}
	public function loadSchedules(){
		$this->db->prepareQuery('SELECT day, openHour, closeHour FROM schedule ORDER BY idOpenSpace');
		$this->db->executeQuery();
		return $this->db->fetchQuery();
	}

	public function updateSchedules($openHour, $closeHour, $day, $id){

		$this->openHour = $openHour;
		$this->closeHour = $closeHour;
		$this->day = $day;
		$this->idOpenSpace = $id;
		$this->db->prepareQuery('UPDATE schedule SET openHour = :openHour, closeHour = :closeHour WHERE idOpenSpace = :idOpenSpace AND day = :day');
		$this->db->executeQuery([
			"openHour" => $this->openHour,
			"closeHour" => $this->closeHour,
			"idOpenSpace" => $this->idOpenSpace,
			"day" => $this->day

		]);

	}

}