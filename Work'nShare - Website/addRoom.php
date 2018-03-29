<?php

require "class/roomClass.php";

if(isset($_POST['result'])){

	$value = $_POST['result'];

	$array = explode('|', $value);

	$room = new Room($array[0], $array[1], $array[2]);
	$room->addRoom();
}else{

}
