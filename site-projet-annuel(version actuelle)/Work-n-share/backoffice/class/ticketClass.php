<?php

require "class/messageClass.php";
require "class/dataBaseClass.php";
class Ticket{
	
	private $error = false;
	public $listOfErrorsTicket = array();
	private $message;
	private $db;
	public function  __construct(){

		$this->message = new Message();
		$this->db = new DataBase();
	}
	private function isError(){
		if($this->error == true){
			
			$_SESSION['error'] = $this->listOfErrorsTicket;
		}
	}
	private function isSuccess(){
		if($this->error == true){
			
			$_SESSION['success'] = $this->listOfErrorsTicket;

		}
	}
	public function isEmpty($value, $index){
		if(empty($value) || $value == null || strlen($value) < 1){
			$this->error = true;
			
			$this->listOfErrorsTicket[] = $this->message->listOfErrorsTicket($index);
			self::isError();

		}
		return $this->error;;
	}

	public function addTicket($title, $author, $description){
		$this->db->prepareQuery('	INSERT INTO ticket(title, state, date_start, author)
									VALUES(?, 0, NOW(), ?)');

		$this->db->executeQuery(array($title, $author));

		$id_ticket = $this->db->lastInsertId();

		$this->db->prepareQuery('	INSERT INTO state_ticket_description(id_ticket, date_post, description, author)
									VALUES(?, NOW(), ?, ?)');
		$this->db->executeQuery(array($id_ticket, $description, $author));

		$this->error = true;

		$this->listOfErrorsTicket[] = $this->message->listOfErrorsTicket(9);
		self::isSuccess();
		
	}

	public function loadStateTicket(){
		$this->db->prepareQuery('SELECT DISTINCT state FROM ticket');
		$this->db->executeQuery();

		return $this->db->fetchQuery();
	}

	public function loadTicketsSortByState($state){
		$this->db->prepareQuery('SELECT * FROM ticket WHERE state = :state ORDER BY id_ticket');
		$this->db->executeQuery([
			"state" => $state
		]);

		return $this->db->fetchQuery();
	}
	public function loadTickets(){
		$this->db->prepareQuery('SELECT * FROM ticket ORDER BY id_ticket');
		$this->db->executeQuery();

		return $this->db->fetchQuery();
	}

	public function loadTicketMessage($id){

		$this->db->prepareQuery('SELECT * FROM state_ticket_description WHERE id_ticket = :id_ticket ORDER BY date_post');
		$this->db->executeQuery([
			"id_ticket" => $id
		]);

		return $this->db->fetchQuery();

	}

	public function addAnswer($id_ticket, $description, $author){

		$this->db->prepareQuery('INSERT INTO state_ticket_description(id_ticket, date_post, description, author)
								VALUES(?, NOW(), ?, ?)');
		$this->db->executeQuery(array($id_ticket, $description, $author));

		$this->error = true;
		$this->listOfErrorsTicket[] = $this->message->listOfErrorsTicket(6);
		self::isSuccess();

	}

	public function updateStateTicket($id, $state){

		$this->db->prepareQuery('UPDATE ticket
								SET state = ?
								WHERE id_ticket = ?');
		$this->db->executeQuery(array($state, $id));

		$this->error = true;
		$this->listOfErrorsTicket[] = $this->message->listOfErrorsTicket(7);
		self::isSuccess();

	}

	public function getTicketState($id){
		$this->db->prepareQuery('SELECT state FROM ticket WHERE id_ticket = :id_ticket');
		$this->db->executeQuery([
			"id_ticket" => $id
		]);

		return $this->db->fetchQuery();
	}
}