<div id="eventError">
<?php

require "class/eventClass.php";
require "class/windowClass.php";
$event = new Event();

if(isset($_POST['addEvent'])){

	$isError1 = false;
	$isError2 = false;
	$isError3 = false;
	$isError4 = false;
	$isError5 = false;
	$isError6 = false;
	$isError7 = false;
	$isError8 = false;
	$isError9 = false;
	$isError10 = false;
	$isError11 = false;
	$nameEvent = $_POST['addEvent'];
	$array = explode('|', $nameEvent);

	$title = $array[0];
	$address = $array[1];
	if(empty($array[2])){
		$date = "";
	}else{
		$date = $array[2];
	}
	
	$time = $array[3];
	$description = $array[4];
	$postalCode = $array[5];
	$city = $array[6];

	$option = $array[7]; //OPTION CHOISIE
	$openspace = $array[8]; //OPENSPACE

	$isError1 = $event->checkValueLength(5, 50, $title, 2);
	$isError2 = $event->titleExist($title); //VERIFIE SI LE TITRE DE L'EVENEMENT EXISTE DEJA
	

	if($option == 1){ //SI ON VEUT SPECIFIER UNE ADRESSE: VERIFIE LA LONGUEUR DES SAISIES
		$isError3 = $event->checkValueLength(5, 255, $address, 10);
		$isError4 = $event->checkValueLength(5, 5, $postalCode, 9);
		$isError5 = $event->checkValueLength(3, 50, $city, 11);
	}

	$isError6 = $event->verifyEvent($date, $time); //VERIFIE SI LA DATE ET L'HEURE SONT VALIDES

	$isError7 = $event->isNull($date, 13); //VERIFIE SI L'UTILISATEUR A SAISI UNE DATE
	$isError8 = $event->isNull($time, 12); //VERIFIE SI L'UTILISATEUR A SAISI UN HORAIRE
	$isError9 = $event->checkValueLength(10, 255, $description, 5); //VERIFIE LA TAILLE DE LA DESCRIPTION
	$isError10 = $event->isNull($openspace, 14); //VERIFIE SI L'UILISATEUR A CHOISI UN OPENSPACE
	if(isset($date) && !empty($date) && isset($openspace) && strlen($openspace) != 0){ //SI LA DATE NEST PAS VIDE

		$isError11 = $event->ifEventExist($date, $openspace); //VERIFIE SI UN EVENEMENT EXISTE DEJA DANS UN OPENSPACE
	}
	

	if(	!$isError1 &&
		!$isError2 &&
		!$isError3 &&
		!$isError4 &&
		!$isError5 &&
		!$isError6 &&
		!$isError7 &&
		!$isError8 &&
		!$isError9 &&
		!$isError10 &&
		!$isError11
	){ //SI IL N'Y A PLUS D'ERREURS
	
		if(isset($_SESSION['error'])){
			unset($_SESSION['error']);

		}
		if($option == 1){
	
			$event->addEvent($title, $address, $postalCode, $city, $date, $time, $description, null);
		}else{
		
			$event->addEvent($title, '', null, '', $date, $time, $description, $openspace);
		}

	}

}

if(isset($_SESSION['error']) && !empty($_SESSION['error'])){
		

	echo '<div id="errors" class="alert alert-danger"><ul">';
	foreach ($_SESSION['error'] as $value) {

		echo '<li><span class="glyphicon glyphicon-remove-sign"></span>'.$value.'</li>';


	}

	echo '</ul></div>';

}

?>

<button type="button" class="close" data-dismiss="modal">&times;</button>
<h2 class="modal-title">Créer un évènement</h2>


</div