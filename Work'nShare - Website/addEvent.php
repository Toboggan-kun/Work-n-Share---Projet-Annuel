<?php

require "class/eventClass.php";
require "class/windowClass.php";
$event = new Event();
$eventArray = new Window();

if(isset($_POST["addEvent"])){
	
	$nameEvent = $_POST['addEvent'];
	$array = explode('|', $nameEvent);
	$error = $event->verifyEvent($array[2], $array[3]);

	if($error == 1){
		$event->addEvent(
		$array[0], 
		$array[1], 
		$array[2], 
		$array[3], 
		$array[4]);
		echo "Evenement ajouté";
		echo $eventArray->createMiniatureEventBox($array[0], $array[4]);
	}else{
		echo "Ajout invalide";
	}
	
}