<?php

require "class/dataBaseClass.php";
class Event{

	public $title;
	public $address;
	public $date;
	public $currentDate;
	public $time;
	public $description;

	public  function __construct(){

	}
	public function isEmpty(){
		$db = new DataBase();
		$db->connectDataBase();
		$db->prepareQuery("SELECT COUNT(*) AS numberEvents FROM event");
		$db->executeQuery();
		$count = $db->fetchQuery();
		return $count;

	}
	public function verifyEvent($date, $time){
		$this->date = $date;
		$this->time = $time;

		$this->date = explode('-', $this->date);
		$this->date = $this->date[2]. '-' . $this->date[1] . '-' . $this->date[0];
		$this->currentDate = date("d-m-Y");
		$currentTime = date("H:i");

		echo $currentTime;

		if($this->currentDate == $this->date){
			
			if($currentTime < $this->time){
				
				return 1;
			}else{
				
				return 0;
			}
		}else if($this->currentDate < $this->date){
			
			return 1;
		}else if($this->currentDate > $this->date){
			return 0;
		}

	}
	public function addEvent($title, $address, $date, $time, $description){
		$this->title = $title;
		$this->address = $address;
		$this->time = $time;
		$this->description = $description;

		$db = new DataBase();
		$db->connectDataBase();
		$db->prepareQuery('INSERT INTO event(
			title, 
			address, 
			dateCreationEvent, 
			dateEvent, 
			hourEvent, 
			descriptionEvent
			) 

			VALUES(:title, :address, :dateCreationEvent, :dateEvent, :hourEvent, :descriptionEvent)

			');

		$db->executeQuery([
			"title" => $this->title,
			"address" => $this->address,
			"dateCreationEvent" => $this->currentDate,
			"dateEvent" => $this->date,
			"hourEvent" => $this->time,
			"descriptionEvent" => $this->description
		]);

		$db->fetchQuery();


	}

	public function deleteEvent(){

	}
	
	public function modifyEvent(){

	}
}