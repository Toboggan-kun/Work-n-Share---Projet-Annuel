<?php

if (isset($_GET['type']) && !empty($_GET['type']) &&
	isset($_GET['name']) && !empty($_GET['name']) &&
	isset($_GET['serial_number']) && !empty($_GET['serial_number']) &&
	isset($_GET['assignment']) && !empty($_GET['assignment']) &&
	isset($_GET['date_purchase']) && !empty($_GET['date_purchase']))
{
	$type = $_GET['type'];
	$name = $_GET['name'];
	$serial_number = $_GET['serial_number'];
	$assignment = $_GET['assignement'];
	$date_purchase = $_GET['date_purchase'];

	// Ajout du matériel
	$req = $bdd->prepare("	INSERT INTO hardware(type, name, serial_number, assignment, date_purchase)
							VALUES(?, ?, ?, ?, ?)");
	$req->execute(array(	$type, $name, $serial_number, $assignment, $date_purchase));

	$added = 1;
} else {
	echo "ERROR : Formulaire incomplet";
}

?>